<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = NewsCategory::paginate(10);
        $success['categories'] = $categories;
        return $this->sendResponse($success, 'Category retrive successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category = $request->all();
        $category['slug']           = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/","-", $category['name']);
        $category['created_by']    = Auth::user()->id;
        $category['updated_by']    = Auth::user()->id;
        NewsCategory::create($category);
        $success['category'] = $category;
        return $this->sendResponse($success, 'Category successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = NewsCategory::find($id);

        $success['category'] = $category;
        return $this->sendResponse($success, 'Category successfully created.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            'slug'          => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category = NewsCategory::find($id);

        $category->name          = $request->name;
        $category->description   = $request->description;
        $category->parent_id     = $request->parent_level;
        $category->slug          = $request->category_slug;
        $category->created_by    = Auth::user()->id;
        $category->save();

        $success['category'] = $category;
        return $this->sendResponse($success, 'Category successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = NewsCategory::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Category successfully deleted.');
    }
}
