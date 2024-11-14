<div class="pl-16">
    <button wire:click="$set('answers_created.open', true)" class="text-gray-900 bg-gray-200 hover:bg-gray-300">
        <i class="fas fa-reply"></i> Responder
    </button>

    @if ($answers_created['open'])
        <div class="mt-4 flex items-start">
            @auth
            
            <figure class="mr-4">
                <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="rounded-full h-12 w-12">
            </figure>
            @endauth
            <div class="flex-1">
                <form wire:submit.prevent="store">
                    <textarea wire:model="answers_created.body" class="mt-1 w-full" placeholder="Escribe tu respuesta"></textarea>
                    <x-input-error for="answers_created.body" class="mt-2"/>
                    <div class="flex justify-end mt-2">
                        <x-danger-button class="mr-2" wire:click="$set('answers_created.open', false)">Cancelar</x-danger-button>
                        <x-button>Responder</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <ul class="space-y-6">
     <!-- Mostrar la última respuesta si existe -->
     @if ($latestAnswer)
     <li wire:key="answer-{{ $latestAnswer->id }}" class="p-4 bg-white rounded-lg shadow-sm">
         <div class="flex items-start">
             <figure class="mr-4">
                 <img class="w-12 h-12 rounded-full" src="{{ $latestAnswer->user->profile_photo_url }}" alt="{{ $latestAnswer->user->name }}">
             </figure>
             <div class="flex-1">
                 <p class="font-semibold">
                     {{ $latestAnswer->user->name }}
                     <span class="text-sm text-gray-500 ml-2">{{ $latestAnswer->created_at->diffForHumans() }}</span>
                 </p>
                 <p class="text-gray-700">{{ $latestAnswer->body }}</p>
         
                 
                 <!-- Botón para responder a esta respuesta -->
                 <button wire:click="$set('answer_to_answer.id', {{ $latestAnswer->id }})" class="text-gray-900 bg-gray-200 hover:bg-gray-300">
                     <i class="fas fa-reply"></i> Responder
                 </button>
                 
                 

                 <!-- Formulario de respuesta a una respuesta -->
                 @if ($answer_to_answer['id'] === $latestAnswer->id)
                     <div class="mt-4 flex items-start">
                         @auth
                             
                         <figure class="mr-4">
                             <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="rounded-full h-12 w-12">
                         </figure>
                         @endauth

                         <div class="flex-1">
                             <form wire:submit.prevent="storeReply">
                                 <textarea wire:model="answer_to_answer.body" class="mt-1 w-full" placeholder="Escribe tu respuesta"></textarea>
                                 <x-input-error for="answer_to_answer.body" class="mt-2"/>
                                 <div class="flex justify-end mt-2">
                                     <x-danger-button wire:click="$set('answer_to_answer.id', null)" class="mr-1">Cancelar</x-danger-button>
                                     <x-button>Responder</x-button>
                                 </div>
                             </form>
                             
                         </div>
                         
                     </div>

                     
                 @endif
                  <!-- Edición de la respuesta si está en modo de edición -->
              @if ($latestAnswer->id == $answer_edit['id'])
              <form wire:submit.prevent="update">
                  <textarea  wire:model="answer_edit.body" rows="2" class=" mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" placeholder="Editar comentario"></textarea>

                  <x-input-error for="answer_edit.body" class="mt-2"/>

                  <div class="flex justify-end mt-2">
                      <x-danger-button class="mr-2" wire:click="cancel">Cancelar</x-danger-button>
                      <x-button>Actualizar</x-button>
                  </div>

              </form>
              @endif
             </div>
             
             <x-dropdown>
                 <x-slot name="trigger">
                     <button type="button" class="text-gray-900 bg-gray-200 hover:bg-gray-300"><i class="fas fa-ellipsis-v"></i></button>
                 </x-slot>
                 <x-slot name="content">
                     <x-dropdown-link wire:click="edit({{ $latestAnswer->id }})">Editar</x-dropdown-link>
                     <x-dropdown-link wire:click="destroy({{ $latestAnswer->id }})">Eliminar</x-dropdown-link>
                 </x-slot>
             </x-dropdown>

             
         </div>
         
     </li>
     @endif
    </ul>

     {{-- Respuesta limitadas --}}
    <ul class="space-y-6">
        @foreach ($answers as $answer)
            <li wire:key="answer-{{ $answer->id }}" class="p-4 bg-white rounded-lg shadow-sm">
                <div class="flex items-start">
                    <figure class="mr-4">
                        <img class="w-12 h-12 rounded-full" src="{{ $answer->user->profile_photo_url }}" alt="{{ $answer->user->name }}">
                    </figure>
                    <div class="flex-1">
                        <p class="font-semibold">
                            {{ $answer->user->name }}
                            <span class="text-sm text-gray-500 ml-2">{{ $answer->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="text-gray-700">{{ $answer->body }}</p>
                
                        
                        <!-- Botón para responder a esta respuesta -->
                        <button wire:click="$set('answer_to_answer.id', {{ $answer->id }})" class="text-gray-900 bg-gray-200 hover:bg-gray-300">
                            <i class="fas fa-reply"></i> Responder
                        </button>
                        
                        

                        <!-- Formulario de respuesta a una respuesta -->
                        @if ($answer_to_answer['id'] === $answer->id)
                            <div class="mt-4 flex items-start">
                                @auth
                                    
                                <figure class="mr-4">
                                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="rounded-full h-12 w-12">
                                </figure>
                                @endauth

                                <div class="flex-1">
                                    <form wire:submit.prevent="storeReply">
                                        <textarea wire:model="answer_to_answer.body" class="mt-1 w-full" placeholder="Escribe tu respuesta"></textarea>
                                        <x-input-error for="answer_to_answer.body" class="mt-2"/>
                                        <div class="flex justify-end mt-2">
                                            <x-danger-button wire:click="$set('answer_to_answer.id', null)" class="mr-1">Cancelar</x-danger-button>
                                            <x-button>Responder</x-button>
                                        </div>
                                    </form>
                                    
                                </div>
                                
                            </div>

                            
                        @endif
                         <!-- Edición de la respuesta si está en modo de edición -->
                     @if ($answer->id == $answer_edit['id'])
                     <form wire:submit.prevent="update">
                         <textarea  wire:model="answer_edit.body" rows="2" class=" mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" placeholder="Editar comentario"></textarea>
 
                         <x-input-error for="answer_edit.body" class="mt-2"/>
 
                         <div class="flex justify-end mt-2">
                             <x-danger-button class="mr-2" wire:click="cancel">Cancelar</x-danger-button>
                             <x-button>Actualizar</x-button>
                         </div>

                     </form>
                     @endif
                    </div>
                    
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button type="button" class="text-gray-900 bg-gray-200 hover:bg-gray-300"><i class="fas fa-ellipsis-v"></i></button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link wire:click="edit({{ $answer->id }})">Editar</x-dropdown-link>
                            <x-dropdown-link wire:click="destroy({{ $answer->id }})">Eliminar</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    
                </div>
                
            </li>
        @endforeach
         <!-- Botón para cargar más comentarios -->
         @if ($this->question->answers()->count() > $limit)
         <div class="flex justify-center mt-4">
             <button wire:click="loadMoreAnswer" class="text-gray py-2 px-4 rounded-lg shadow-md hover:text-blue-600">
                 Ver más respuestas
             </button>
         </div>
     @endif
    </ul>
    <!-- Botón para cargar más comentarios -->

</div>