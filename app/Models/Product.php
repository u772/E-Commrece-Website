<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Categories;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=[
        'category_id',
        'name',
        'slug',
        'brand',
        'image',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'meta_title',
        'meta_keyword',
        'meta_description',
       
    ];


    public function Category(){
        return $this->belongsTo(Categories::class,'category_id','id');
    }
    public function productImages(){
        return $this->hasMany(ProductImages::class,'product_id','id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
