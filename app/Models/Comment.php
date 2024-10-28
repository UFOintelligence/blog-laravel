<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //Relacion de uno a muchos

    public function user(){
        return $this->belongsTo(User::class);
    }

     //Relacion polimorfica
     public function commentable(){
        return $this->morphTo();
    }

      //Relacion polimorfica uno a mucho
      public function images(){
        return $this->morphMony(Image::class, 'imageable');
    }

}
