<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsArticleRequest;
use App\Repositories\NewsArticleRopository;
use App\Http\Resources\NewsArticles\NewsArticleResource;

class NewsArticleController extends Controller
{
    private $newsArticleRepo;
    public function __construct(NewsArticleRopository $NeswArticleRopository)
    {
        $this->newsArticleRepo = $NeswArticleRopository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->newsArticleRepo->getNewsArticleList($request);
        return NewsArticleResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsArticleRequest $request)
    {
        $this->newsArticleRepo->createNewsArticle($request);
        return response()->json(['status'=>true,'message'=>'The process successful.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->newsArticleRepo->NewsArticleEdit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsArticleRequest $id)
    {
        $this->newsArticleRepo->NewsArticleUpdate($id);
        return response()->json(['status'=>true,'message'=>'The process successful.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
