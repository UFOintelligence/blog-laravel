<div class="bg-gray-100 shadow-md rounded-lg p-6"> <!-- Color de fondo cambiado -->
    <!-- Comentario del usuario actual -->
    @if(auth()->id())
    <div class="flex items-start mb-6">
        <!-- Imagen de perfil del usuario -->
        <figure class="mr-4">
            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="rounded-full h-12 w-12 object-cover object-center shadow-md">
        </figure>

        <!-- Formulario para crear comentario -->
        <div class="flex-1">
            <form wire:submit.prevent="store()">
                <textarea wire:model.defer="message" rows="2" class="mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" placeholder="Escribe tu comentario"></textarea>
                
                <x-input-error for="message" class="mt-2"/>

                <div class="flex justify-end mt-4">
                    <x-button>Comentar</x-button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Título de sección de comentarios -->
<p class="text-lg font-semibold mt-6 mb-4">
    <i class="fa fa-solid fa-comment mr-1"></i>  Cometarios {{ $totalComments }}
</p>

    <!-- Lista de comentarios -->
    <ul class="space-y-6">
        @foreach ($this->questions as $question)
        <li wire:key="question-{{ $question->id }}" class="p-4 bg-white rounded-lg shadow-sm"> <!-- Color de fondo para cada comentario -->
            <div class="flex items-start">
                <!-- Imagen de perfil del comentario -->
                <figure class="mr-4">
                    <img class="w-12 h-12 object-cover object-center rounded-full shadow-md" alt="{{ $question->user->name }}" src="{{ $question->user->profile_photo_url }}">
                </figure>

                <!-- Contenido del comentario -->
                <div class="flex-1">
                    <!-- Autor y fecha del comentario -->
                    <p class="font-semibold">
                        {{ $question->user->name }}
                        <span class="text-sm font-normal text-gray-500 ml-2">
                            {{ $question->created_at->diffForHumans() }}
                        </span>
                    </p>

                    <!-- Edición de comentario si está en modo de edición -->
                    @if ($question->id == $question_edit['id'])
                    <form wire:submit.prevent="update">
                        <textarea wire:model="question_edit.body" rows="2" class="mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" placeholder="Editar comentario"></textarea>

                        <x-input-error for="question_edit.body" class="mt-2"/>

                        <div class="flex justify-end mt-2">
                            <x-danger-button class="mr-2" wire:click="cancel">Cancelar</x-danger-button>
                            <x-button>Actualizar</x-button>
                        </div>
                    </form>

                    @else
                    <!-- Visualización del comentario -->
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $question->body }}
                    </p>
                    @endif
                </div>

                <!-- Menú desplegable de acciones (Editar/Eliminar) -->
                @if ($question->user_id == auth()->id())
                <div class="ml-4">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button type="button" class="text-gray-900 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm p-2.5 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link class="cursor-pointer" wire:click="edit({{ $question->id }})">
                                Editar
                            </x-dropdown-link>
                            <x-dropdown-link class="cursor-pointer" wire:click="destroy({{ $question->id }})">
                                Eliminar
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif
            </div>

            <!-- Respuestas al comentario -->
            <div class="mt-4">
                @livewire('answer', ['question' => $question], key('answer-'.$question->id))
            </div>
        </li>
        @endforeach
    </ul>
    <!-- Botón para cargar más comentarios -->
@if ($this->model->questions()->count() > $limit)
<div class="flex justify-center mt-4">
    <button wire:click="loadMore" class="text-gray py-2 px-4 rounded-lg shadow-md hover:text-blue-600">
        Ver más comentarios
    </button>
</div>
@endif


</div>
