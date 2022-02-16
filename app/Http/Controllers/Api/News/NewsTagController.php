<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsTag;

class NewsTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = NewsTag::paginate(10);
        $success['tags'] = $tags;
        return $this->sendResponse($success, 'Tag retrive successfully.');
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
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $tag = new NewsTag;
        $tag->name          = $request->name;
        $tag->description   = $request->description;
        $tag->created_by    = Auth::user()->id;
        $tag->save();

        $success['tag'] = $tag;
        return $this->sendResponse($success, 'Tag successfully updated.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = NewsTag::find($id);
        $success['tag'] = $tag;
        return $this->sendResponse($success, 'Tag successfully created.');
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
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $tag = NewsTag::find($id);

        $tag->name          = $request->name;
        $tag->description   = $request->description;
        $tag->updated_by    = Auth::user()->id;
        $tag->save();

        $success['tag'] = $tag;
        return $this->sendResponse($success, 'Tag successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = NewsTag::delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Tag successfully deleted.');
    }
}
