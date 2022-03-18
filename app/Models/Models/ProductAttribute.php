<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $fillable =[
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
