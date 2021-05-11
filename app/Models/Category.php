<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const IMAGES_PATH = 'storage/categories/photo';
    use HasFactory;
    protected $guarded=[];

    public function getId() {
        return $this->id;
    }

    public function products(){
       return $this->belongsToMany(Product::class,'product_categories')->withTimestamps();
    }
}
