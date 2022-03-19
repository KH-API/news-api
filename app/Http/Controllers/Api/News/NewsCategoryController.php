<?php

namespace App\Http\Controllers\Api\News;

use App\Models\NewsCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;

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
    public function store(NewsCategoryRequest $request)
    {
        try {
            $category = $request->all();
            $category['created_by']    = Auth::user()->id;
            NewsCategory::create($category);
            $success['category'] = $category;
            return $this->sendResponse($success, 'Category successfully created.');
            DB::commit();
        } catch (\Exception $exp) {
            DB::rollBack();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(UpdateNewsCategoryRequest $request, $id)
    {
        try {
            $category = $request->all();
            $category['updated_by']    = Auth::user()->id;
            NewsCategory::where('id',$id)->update($category);
            $success['category'] = $category;
            return $this->sendResponse($success, 'Category successfully updated.');
            DB::commit();
        } catch (\Exception $exp) {
            DB::rollBack();
        }
        
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
