<?php

namespace App\Models;

use App\Traits\GetImagePath;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, GetImagePath;
    protected $guarded = ['id','created_at','updated_at'];    
    public function items(){
        return $this->hasMany(Item::class);
    }
}
