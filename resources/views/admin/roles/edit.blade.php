<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Roles',
'url'  => route('admin.roles.index'),

],
[
'name' => 'Editar',

]

]">
    <form action="{{route('admin.roles.update', $role)}}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">

        @csrf
        @method('PUT')


  <x-validation-errors class="mb-4"/>
    <div class="mb-4">
        <x-label>Actualizar Nombre</x-label>

        <x-input class="w-full" placeholder="Escriba el nombre del rol" name="name"
        value="{{$role->name}}"/>

    </div>

    <div class="mb-4">
        <ul>
            @foreach ($permissions as $permission )
            <li>
                <label>
                    <x-checkbox name="permissions[]"
                    value="{{$permission->id}}"
                    :checked="in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))"/>
                    {{$permission->name}}
                </label>
            </li>

            @endforeach
        </ul>
    </div>

    <div class="flex justify-end mb-2">

            <x-danger-button type="button" class="mr-2" onclick="deleteRol()">Eliminar</x-danger-button>


            <x-button> Actualizar</x-button>

    </div>
    </form>



    <form action="{{route('admin.roles.destroy', $role)}}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>

    @push('js')

    <script>
    function deleteRol(){

    let form = document.getElementById('formDelete');
    form.submit();

    }
    </script>

    @endpush


    </x-admin-layout>
