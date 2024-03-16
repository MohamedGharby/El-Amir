<?php

namespace App\Models;

use App\Traits\GetImagePath;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory , GetImagePath;
    protected $guarded = ['id','created_at','updated_at'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function productImgs(){
        return $this->hasMany(Product_img::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
