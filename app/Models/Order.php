<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function products(){
        $this->belongsToMany(Product::class)->withTimestamps;
    }
    public function actions(){
        $this->belongsToMany(Action::class)->withTimestamps;
    }
}
