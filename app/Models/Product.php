<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['price', 'image'];

    public $translatedAttributes = ['name', 'description'];

    protected $appends = ['image_path'];

    public $timestamps = false;

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/'.$this->image);
    }//end of get image path

}
