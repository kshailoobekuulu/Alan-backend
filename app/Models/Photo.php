<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function banners(){
       return $this->belongsToMany(Banner::class,'banner_photos')->withTimestamps();
    }
}
