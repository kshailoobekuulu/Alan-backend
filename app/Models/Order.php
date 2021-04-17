<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function products(){
       return $this->belongsToMany(Product::class,'ordered_products')->withTimestamps();
    }
    public function actions(){
       return $this->belongsToMany(Action::class,'ordered_actions')->withTimestamps();
    }
}
