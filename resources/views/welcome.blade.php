<x-app-layout>
    
    <!-- Imagen de encabezado -->
    <figure class="mb-12">
        <img src="{{ asset('img/home/9.jpg') }}" class="w-full aspect-[3/1] object-cover object-center">
    </figure>

    <!-- Sección principal -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-3xl text-center font-semibold mb-4">Publicaciones</h1>

        <!-- Contenedor principal con 4 columnas -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Filtros (Sidebar) -->
            <div class="col-span-1 bg-white shadow-lg  rounded-lg p-4 n transition-transform hover:scale-105 duration-300 relative overflow-hidden">
                <form action="{{ route('home') }}" method="GET">
                    <!-- Filtro de búsqueda -->
                    <div class="mb-4">
                        <p class="text-lg font-semibold">Buscar:</p>
                        <input type="text" name="search" value="" placeholder="Buscar publicaciones..."
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Filtro de orden -->
                    <div class="mb-4">
                        <p class="text-lg font-semibold">Ordenar:</p>
                        <select name="order" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="new" @selected(request('order') == 'new')>Más nuevos</option>
                            <option value="old" @selected(request('order') == 'old')>Más antiguos</option>
                        </select>
                    </div>

                    <!-- Filtro de categorías -->
                    <div class="mb-4">
                        <p class="text-lg font-semibold">Categorías:</p>
                        <ul class="space-y-2">
                            @foreach ($categories as $category)
                                <li>
                                    <label class="flex items-center">
                                        <x-checkbox name="category[]" value="{{ $category->id }}" 
                                                    :checked="is_array(request('category')) && in_array($category->id, request('category'))"/>
                                        <span class="ml-2">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Botón de aplicar filtros -->
                    <x-button>Aplicar filtros</x-button>
                </form>
            </div>

            <!-- Publicaciones -->
            <div class="col-span-3 space-y-8 mt-8">
                @foreach ($posts as $post)
                    <article class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-white shadow-lg rounded-lg p-6 transition-transform hover:scale-105 duration-300 relative overflow-hidden">
                        <!-- Fondo de tarjeta -->
                        <div class="absolute inset-0  rounded-lg"></div>

                        <!-- Imagen -->
                        <div class="relative z-10">
                            <figure>
                                <img class="aspect-[15/10]  object-cover object-center w-full rounded-lg transition-all hover:scale-105"
                                     alt=" {!! $post->title !!}" src="{{ $post->image }}">
                            </figure>
                        </div>

                        <!-- Contenido -->
                        <div class="relative z-10 flex flex-col justify-between">
                            <div>
                                <h1 class="text-xl font-semibold text-gray-900">{!! $post->title !!}</h1>
                                <hr class="mt-1 mb-2">

                                <!-- Etiquetas -->
                                <div class="mb-2">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('home', ['tag' => $tag->name]) }}">
                                            <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold mr-2 px-2.5 py-0.5 mb-1 rounded hover:bg-blue-500 hover:text-white transition">{{ $tag->name }}</span>
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Fecha de publicación -->
                                <p class="text-sm text-gray-500 mb-2">{{ $post->published_at->format('d M Y') }}</p>

                                <!-- Extracto -->
                                <div class="mb-8">{{ Str::limit(strip_tags($post->excerpt), 100) }}</div>

                            </div>

                            <!-- Botón Ver más -->
                            <div class="flex justify-end -mt-8">
                                <a href="{{ route('posts.show', $post) }}" class="bg-blue-700 text-white rounded-full px-5 py-2.5 hover:bg-blue-800 transition">Ver más</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
 <!-- Lista de usuarios con opción de chat -->
 {{-- <div class="col-span-1 bg-white shadow-lg rounded-lg p-6 " x-data="{ openChat: null }">
    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
        <div class="flex justify-center">
            <h1>Chat</h1>
        </div>
        @foreach ( $users as $user )
        <li class="py-3 sm:py-4 cursor-pointer" @click="openChat = openChat === {{ $user->id }} ? null : {{ $user->id }}">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <div class="relative mt-4">
                    <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="profile image">
                    <span class="top-0 start-7 absolute w-3.5 h-3.5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Ventana de chat emergente -->
            <div x-show="openChat === {{ $user->id }}" class="fixed bottom-4 right-4 w-72 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-50" @click.away="openChat = null">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                    <button @click="openChat = null" class="text-gray-500 hover:text-gray-700">
                        &times;
                    </button>
                </div>
                <div class="overflow-y-auto h-48 mb-4">
                    <!-- Aquí irán los mensajes -->
                    <div class="text-sm text-gray-600">
                        <p>Mensaje del usuario {{ $user->name }}...</p>
                    </div>
                </div>
                <form @submit.prevent="sendMessage" class="flex">
                    <input type="text" @click.stop  class="w-full border-gray-300 rounded-l-lg focus:ring-0 focus:border-blue-500" placeholder="Escribe un mensaje...">
                    <button type="submit" @click.stop class="bg-blue-500 text-white rounded-r-lg px-4 hover:bg-blue-600">Enviar</button>
                </form>
                
            </div>
        </li>
       
        @endforeach
    </ul>
</div> --}}





<!-- Paginación -->
<div class="mt-4">{{ $posts->links() }}</div>
</section>

    
</x-app-layout>
