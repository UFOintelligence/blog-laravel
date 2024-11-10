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
'name' => 'Editar',

]

]">

    <form action="{{route('admin.permission.update', $permission)}}" method="POST"
     class="bg-white rounded-lg p-6 shadow-lg">


        @csrf

       @method('PUT')

  <x-validation-errors class="mb-4"/>


  <div class="mb-4">

    <x-label class="mb-2">Actualizar Nombre</x-label>

    <x-input class="w-full" placeholder="Escriba el nombre del permiso "
    name="name" value="{{$permission->name}}"/>

  </div>

  <div class="flex justify-end mb-2">
    <x-danger-button type="button" class="mr-2" onclick="deletePermission()">
        Eliminar
    </x-danger-button>

    <x-button>
        Actualizar
    </x-button>
</div>

    </form>


<form action="{{route('admin.permission.destroy', $permission)}}" method="POST" id="formDelete">
    @csrf
    @method('DELETE')

</form>

@push('js')

<script>
function deletePermission(){

let form = document.getElementById('formDelete');
form.submit();

}
</script>

@endpush

</x-admin-layout>
