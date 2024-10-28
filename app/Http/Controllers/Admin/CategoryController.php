<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $categories = Category::latest('id')->paginate(5);
       // return $categories;
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        Category::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La categorìa fuè creada corretamente'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    public function edit(Category $category)
    {
        //

        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        $category-> update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La categorìa se actalizò corretamente'
        ]);

        return redirect()->route('admin.categories.edit', $category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
$posts = Post::where('category_id', $category->id)->exists();

if ($posts) {
    session()->flash('swal', [
        'icon' => 'error',
        'title' => '¡Error!',
        'text' => 'La categorìa no se puede eliminar porque tienes
        posts asociados'
    ]);
    return redirect()->route('admin.categories.edit', $category);

}
    $category->delete();

    session()->flash('swal', [
        'icon' => 'success',
        'title' => '¡Bien hecho!',
        'text' => 'La categorìa se elimino corretamente'
    ]);

    return redirect()->route('admin.categories.index');


    }
}
