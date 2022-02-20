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
                'seo_keyword'   => $request->seo_keyword,
                'view_counter'  => $request->view_counter,
                'is_active'     => $request->is_active,
                'created_by'    => 1,
                'updated_by'    => 1,
            ]);
            DB::commit();
        } catch (\Exception $exp) {
            DB::rollBack();
        }
    }
}
