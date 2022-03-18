<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
        'status_id',
        'name',
        'description',
        'product_photo',
        'price',
        'discount_price',
        'content',
        'created_by',
        'updated_by'
    ];
}
