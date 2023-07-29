<?php

namespace App\Models;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'tittle',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',

    ];

   

      public function brands(): HasMany
      {
          return $this->hasMany(Brands::class, 'category_id', 'id');
      }

      public function product(){
        return $this->hasMany(Product::class,'category_id','id');
      }
}
