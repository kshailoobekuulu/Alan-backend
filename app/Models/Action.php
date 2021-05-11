<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    const IMAGES_PATH = 'storage/actions';
    use HasFactory;
    protected $guarded=[];

    public function products(){
       return $this->belongsToMany(Product::class,'action_products')->withPivot('quantity');
    }
    public function orders(){
       return $this->belongsToMany(Order::class,'ordered_actions')->withTimestamps();
    }
}
