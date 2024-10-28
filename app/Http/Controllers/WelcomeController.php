<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
class WelcomeController extends Controller
{
   public function __invoke(){



   $categories = Category::all();
   $posts = Post::where('published', true)
   ->filter(request()->all())
   ->orderBy('published_at', 'desc')
   ->orderBy('id', 'desc')
   ->paginate(10);

   $users = User::all();



    return view('welcome', compact('posts', 'categories', 'users'));
   }


}
