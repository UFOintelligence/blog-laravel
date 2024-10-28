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
'name' => 'Editar',

]

]">

    <form action="{{route('admin.categories.update', $category)}}" method="POST"
     class="bg-white rounded-lg p-6 shadow-lg">


        @csrf

       @method('PUT')

  <x-validation-errors class="mb-4"/>


  <div class="mb-4">

    <x-label class="mb-2">Actualizar Nombre</x-label>

    <x-input class="w-full" placeholder="Escriba el nombre de la categoria"
    name="name" value="{{$category->name}}"/>

  </div>

  <div class="flex justify-end mb-2">
    <x-danger-button type="button" class="mr-2" onclick="deleteCategory()">
        Eliminar
    </x-danger-button>

    <x-button>
        Actualizar
    </x-button>
</div>

    </form>


<form action="{{route('admin.categories.destroy', $category)}}" method="POST" id="formDelete">
    @csrf
    @method('DELETE')

</form>

@push('js')

<script>
function deleteCategory(){

let form = document.getElementById('formDelete');
form.submit();

}
</script>

@endpush

</x-admin-layout>
