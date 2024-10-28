<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tags;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\facades\Gate;
use Livewire\WithPagination;
class PostController extends Controller
{
    use WithPagination;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::where('user_id', auth()->id())->latest('id')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=> 'required',
            'slug'=> 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
        ]);


        $posts = Post::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el post fuè creado corretamente'
        ]);

        return redirect()->route('admin.posts.edit', $posts);
        //
    }


    /**
     * Show the form for editing the sp´
     * -ecified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //protegiendo la ruta del autor (usuario)
        if(!Gate::allows('author', $post)){

            abort(403, 'No puede editar este post porque  no le pertenece');
        }

        //$this->authorize('author', $post);
        $categories = Category::all();
        // $tags= Tags::all();
        // return $tags;


        return view('admin.posts.edit', compact('post','categories'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required',
            'slug'=> 'required|unique:posts,slug,' . $post->id,
            'category_id'=> 'required|exists:categories,id',
            'excerpt'=> $request->published ? 'required' : 'nullable',
           'body'=> $request->published ? 'required' : 'nullable',
            'published'=> 'required|boolean',
            'tags'=> 'nullable|array',
            'image'=> 'nullable|image',
        ]);

        $data = $request->all();

       $tags = [];

       foreach($request->tags ?? [] as $name){

         $tag = Tags::firstOrCreate([

            'name' => $name,

         ]);

       $tags[] = $tag->id;


       }

        $post->tags()->sync($tags);


         if($request->file('image')){

            if($post->image_path){

                Storage::delete($post->image_path);
            }

             $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

         $data ['image_path'] =  Storage::disk('public')->putFileAs('posts', $request->image, $file_name, 'public');

            // $data ['image_path'] = $request->file('image')->storeAs('posts', $file_name,
            //  ['disk'=> 's3', 'visibility' => 'public']);


         }

        $post->update($data);
        //$post->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el post fuè actualizado corretamente'
        ]);

        return redirect()->route('admin.posts.edit', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el post se elimino corretamente'
        ]);

        return redirect()->route('admin.posts.index');


    }
}
