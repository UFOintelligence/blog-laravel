<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Permisos',
'url'  => route('admin.permission.index'),

],
[
'name' => 'Nuevo',

]

]">

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{route('admin.permission.store')}}" method="POST">

            @csrf
            <x-validation-errors class="mb-4"/>
            <div class="mb-4">
            <label class="mb-1">Nombre del permiso</label>

            <x-input  name="name"  class="w-full" placeholder="Ingrese el nombre"
            value="{{old('name')}}"/>


           </div>

          <div  class="flex justify-end">
            <x-button>Crear permiso</x-button>
          </div>

        </form>

    </div>




</x-admin-layout>
