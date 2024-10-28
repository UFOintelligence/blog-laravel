<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
     //Relacion muchos a muchos polimorfica inversa
     public function Post(){
        return $this->morphedByMany(Post::class,'taggable');
    }

}
