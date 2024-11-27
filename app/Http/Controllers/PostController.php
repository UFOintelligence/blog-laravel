<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //
    public function image(Post $post){

         $image = Storage::get($post->image_path);
         return response($image)->header('Content-Type', 'image/jpeg');

        // return Storage::temporaryUrl(
        //     $post->image_path,
        //      now()->addMinutes(5)
        //  );
    }

    public function show(Post $post)
    {
        //
        return view('posts.show', compact('post'));
    }

    public function getRouteKeyName()
{
    return 'slug';
}


    public function searchAutocomplete(Request $request)
    {
        $query = $request->input('query');
    
       $results = \App\Models\Post::where('title', 'LIKE', "%{$query}%")
    ->take(10)
    ->get(['id', 'title', 'slug'])
    ->map(function ($post) {
        return [
            'title' => $post->title,
            'url' => route('posts.show', $post), // Laravel generará la URL usando el método getRouteKeyName
        ];
    });

return response()->json($results);

    }
}
