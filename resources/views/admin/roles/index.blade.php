<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Roles',

]

]">

<x-slot name="action">

    <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
    href="{{route('admin.roles.create')}}">
       Nuevo
   </a>
 </x-slot>


 @if($roles->count())

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                  Nombre
                </th>

                <th scope="col" class="px-6 py-3">
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ( $roles as $rol )

          @if (auth()->user()->role === 'superadmin')
    <p class="text-gray-500">Superadministrador: Puedes ver todos los posts.</p>
@endif

          <tr class="bg-white dark:bg-gray-800">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{$rol->id}}
            </th>
            <td class="px-6 py-4">
                {{$rol->name}}
            </td>

            <td class="px-6 py-4">
                <a href="{{route('admin.roles.edit', $rol )}}">Editar</a>
            </td>
           @endforeach


            </tr>
        </tbody>
    </table>
</div>


@else

<div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <span class="font-medium">Información</span> Todavía no tienes roles  agregados.
  </div>

  @endif


</x-admin-layout>
