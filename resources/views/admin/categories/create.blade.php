<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Categorias',
'url'  => route('admin.categories.index'),

],
[
'name' => 'Nuevo',

]

]">

    <form action="{{route('admin.categories.store')}}" method="POST"
     class="bg-white rounded-lg p-6 shadow-lg">


        @csrf

  <x-validation-errors class="mb-4"/>


  <div class="mb-4">

    <x-label class="mb-2">Nombre</x-label>

    <x-input class="w-full" placeholder="Escriba el nombre de la categoria" name="name"/>

  </div>

  <div class="flex justify-end mb-2">

    <x-button>
        Crear Categorìa
    </x-button>
</div>

    </form>

</x-admin-layout>
