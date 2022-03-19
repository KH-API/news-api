<?php

namespace App\Http\Controllers\Api\News;

use App\Models\NewsTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Http\Requests\NewsTagRequest;

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
    public function store(NewsTagRequest $request)
    {
        try {
            $tag = $request->all();
            $tag['created_by']    = Auth::user()->id;
            NewsTag::create($tag);
            $success['tag'] = $tag;
            return $this->sendResponse($success, 'Tag successfully created.');
            DB::commit();
        } catch (\Throwable $exp) {
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
    public function update(NewsTagRequest $request, $id)
    {
        try {
            $tag = $request->all();
            $tag['updated_by']    = Auth::user()->id;
            NewsTag::where('id',$id)->update($tag);
            $success['tag'] = $tag;
            return $this->sendResponse($success, 'Tag successfully updated.');
            DB::commit();
        } catch (\Throwable $exp) {
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
        $deleted = NewsTag::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Tag successfully deleted.');
    }
}
