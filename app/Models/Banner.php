<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const IMAGES_PATH = 'storage/banners';
    use HasFactory;
    protected $guarded=[];

}
