<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $table = 'news_categories';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
        'name',
        'description',
        'parent_id',
        'slug',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
