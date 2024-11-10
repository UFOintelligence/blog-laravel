<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'body',
        'user_id',
        'published',
        'image_path',
        'published_at',

    ];

    protected $casts =  [
        'published'=> 'boolean',
        'published_at' => 'datetime',

    ];

    protected  function title(): Attribute{
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value),
        );

    }

    protected  function image(): Attribute{
        return new Attribute(

       get: function(){

        if($this->image_path){
            //verificar si la url empieza con https: o http
            if(substr($this->image_path, 0, 8) == 'https://') {

                return $this->image_path;
            }

             return Storage::url($this->image_path);
             //return route('posts.image', $this);

            //  return Storage::temporaryUrl(
            //      $this->image_path,
            //        now()->addMinutes(5)
            //    );

        }else{
            return 'https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg?w=996';
        }

       }

        );


    }

     //Relacion  de uno a muchos inversa
 public function category(){

    return $this->belongsTo(Category::class);
 }
    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

  //Relacion polimorfica uno a mucho

public function comments(){


    return $this->morphMany(Comment::class, 'commentable');

    }


    //Relacion muchos a muchos polimorfica
    public function tags(){
        return $this->morphToMany(Tags::class, 'taggable');
    }

    //Relacion uno a muchos polimorfica
    public function questions(){

        return $this->morphMany(Question::class, 'questionable');
    }


   public function scopeFilter($query, $filters){
    $query->when($filters['category'] ?? null, function($query, $category){
        $query->whereIn('category_id', $category);
       })->when($filters['order'] ?? 'new', function($query, $order){

        $sort = $order == 'new' ? 'desc' : 'asc';
        $query->orderBy('published_at', $sort);
       })->when($filters['tag'] ?? null, function($query, $tag){

        $query->whereHas('tags', function($query) use ($tag){
            $query->where('tags.name', $tag);
        });
       });
   }

}
