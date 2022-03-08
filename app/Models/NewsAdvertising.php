<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAdvertising extends Model
{
    use HasFactory;
    protected $table = 'news_advertisings';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
        'category_id',
        'name',
        'ads_image',
        'ads_link',
        'ads_position',
        'start_date',
        'end_date',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
