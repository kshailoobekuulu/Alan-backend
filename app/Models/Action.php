<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function products(){
       return $this->belongsToMany(Product::class,'action_products','product_id','action_id')->withTimestamps;
    }
    public function orders(){
       return $this->belongsToMany(Order::class)->withTimestamps;
    }
}
