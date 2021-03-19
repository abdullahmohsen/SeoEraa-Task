<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'locale', 'image', 'slogan', 'direction', 'active'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getActive()
    {
        return $this->active == 1 ? __('site.activate') : __('site.deactivate');
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/language_images/'.$this->image);
    }//end of get image path
}
