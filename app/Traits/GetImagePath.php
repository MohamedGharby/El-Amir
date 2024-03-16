<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait GetImagePath{
    public function img():Attribute{
       
        return new Attribute(
            get: function($value){
        
               if ($value == null) {
                   
                 return null;

                 
               }
        
               return "uploads/".$value;
            }
        );
    }
}