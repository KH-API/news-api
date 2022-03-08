<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;
    protected $table = 'news_articles';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
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
        'created_by',
        'updated_by'
    ];
}
