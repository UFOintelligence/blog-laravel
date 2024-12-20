<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'user_id', 'question_id'];
    // En el modelo Answer.php


    //Relacion de uno a mucho inversa
    public function user(){

        return $this->belongsTo(User::class);
    }
    //Relacion de uno a mucho inversa

    public function question(){

        return $this->belongsTo(Question::class);
    }
   
    
}
