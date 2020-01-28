<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $guarded=[];


  public function path(){
     
    return url('/images'.$this->id);

    }


  
}


