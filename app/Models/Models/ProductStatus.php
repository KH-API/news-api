<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;
    protected $table = 'product_statsus';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
