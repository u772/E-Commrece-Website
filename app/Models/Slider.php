<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table='sliders';

    protected $fillable=[
      'title',
      'heading',
    ];

    public function sliderImages(){
        return $this->hasMany(SliderImage::class,'slider_id','id');
    }
}
