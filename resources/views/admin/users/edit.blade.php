<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Usuarios',
'url'  => route('admin.users.index'),

],
[
'name' => 'Editar',

]

]">
    <form action="{{route('admin.users.update', $user)}}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">

        @csrf
        @method('PUT')


  <x-validation-errors class="mb-4"/>
    <div class="mb-4">
        <x-label>Actualizar Nombre</x-label>

        <x-input class="w-full" placeholder="Escriba el nombre del usuario" name="name"
        value="{{old('name', $user->name)}}"/>

    </div>


    <div class="mb-4">
        <x-label>Actualizar Email</x-label>

        <x-input  type="email" class="w-full"  name="email"
        value="{{ old('email', $user->email) }}" placeholder="Escriba el email"/>

    </div>

    <div class="mb-4">
        <x-label>Actualizar Password</x-label>

        <x-input  type="password" class="w-full" placeholder="Escriba el password" name="password"
         required
        />

    </div>

    <div class="mb-4">
        <x-label>Confirmar Password</x-label>

        <x-input  type="password" class="w-full" placeholder="confirme el password"
        name="password_confirmation" required
        />

    </div>

    <div class="mb-4">
        <ul>
            @foreach ($roles as $role )
            <li>
                <label>
                    <x-checkbox name="roles[]"
                    value="{{$role->id}}"
                    :checked="in_array($role->id, old('roles', $user->
                    roles->pluck('id')->toArray()))"/>
                    {{$role->name}}
                </label>
            </li>

            @endforeach
        </ul>
    </div>


    <div class="flex justify-end mb-2">

            <x-danger-button type="button" class="mr-2" onclick="deleteUsers()">Eliminar</x-danger-button>


            <x-button> Actualizar</x-button>

    </div>
    </form>



    <form action="{{route('admin.users.destroy', $user)}}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>

    @push('js')

    <script>
    function deleteUsers(){

    let form = document.getElementById('formDelete');
    form.submit();

    }
    </script>

    @endpush


    </x-admin-layout>
