<?php

namespace App\Repositories;

use App\Models\NewsArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class BankRepository
 * @package App\Repositories\V1\Bank
 * @version July 20, 2020, 3:07 am UTC
 */

class NewsArticleRopository 
{
    /** 
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title',
        'description',
        'article_slug',
        'article_photo',
        'content',
        'tag',
        'seo_keyword',
        'view_counter',
        'is_active',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NewsArticle::class;
    }
    public function getNewsArticleList()
    {
        return NewsArticle::all();
    }
    public function createNewsArticle($request){
        if($request->hasFile('article_photo')) {
            $image = $request->file('article_photo');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('uploads/article'), $filename);
        }
        try {
            DB::beginTransaction();
            NewsArticle::create([
                'category_id'   => $request->category_id,
                'title'         => $request->title,
                'description'   => $request->description,
                'article_slug'  => preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/","-", $request->title),
                'article_photo' => $filename,
                'content'       => $request->content,
                'tag'           => $request->tag,
                'seo_keyword'   => $request->seo_keyword,
                'view_counter'  => $request->view_counter,
                'is_active'     => $request->is_active,
                'created_by'    => Auth::user()->id,
                'updated_by'    => Auth::user()->id,
            ]);
            DB::commit();
        } catch (\Exception $exp) {
            DB::rollBack();
        }
    }

    public function NewsArticleEdit($id){
      return NewsArticle::find($id);
    }

    public function NewsArticleUpdate($request){
        if($request->hasFile('article_photo')) {
            $image = $request->file('article_photo');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('uploads/article'), $filename);
        }else{
            $filename = $request->oldImage;
        }
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['article_slug']   =  preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/","-", $request->title);
            $data['article_photo']  =  $filename;
            $data['created_by']     =  Auth::user()->id;
            $data['updated_by']     =  Auth::user()->id;
            NewsArticle::where('id',$request->id)->update($data);
            DB::commit();
        } catch (\Exception $exp) {
            DB::rollBack();
        }
    }
}
