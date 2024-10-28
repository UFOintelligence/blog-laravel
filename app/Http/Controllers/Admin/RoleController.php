<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\PermissionController;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
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
            'name'=> ['required', 'unique:roles,name'],
            'permisions'=> 'nullable|array',
         ]);

         $role = Role::create($request->all());
         $role->permissions()->attach($request->permissions);

         session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el rol se creó corretamente'
        ]);

        return redirect()->route('admin.roles.edit', $role);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $permissions = Permission::all();
        // $permissions = $role->Permission->pluck('id')->toArray();
        // dd(in_array(1, $permissions));

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)

    {

        $request->validate([

            'name' => 'required|string|max:255', 'unique:roles,name' . $role->id,
            'permissions' => 'nullable|array'
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);


        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el rol se actualizó corretamente'
        ]);

        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'el rol se eliminó corretamente'
        ]);

        return redirect()->route('admin.roles.index', $role);
    }
}
