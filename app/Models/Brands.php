<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brands extends Model
{
    use HasFactory;
    protected $table="brands";
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id'

    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'brand_id', 'id');
    // }
}
