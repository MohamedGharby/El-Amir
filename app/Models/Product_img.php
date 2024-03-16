<?php

namespace App\Models;

use App\Traits\GetImagePath;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_img extends Model
{
    use HasFactory , GetImagePath;
    protected $guarded = ['id','created_at','updated_at'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
