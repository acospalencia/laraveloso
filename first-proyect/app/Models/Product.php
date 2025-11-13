<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

     public static function getAllProducts()
     {
        return DB::table('products')->select('name', 'description', 'price')->get();
     }
}
