  <x-app-layout>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white p-8 rounded-lg shadow-lg">

            <form action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-validation-errors class="mb-4"/>

             <div class="mb-4">
                <x-label>
                    Nombre
                </x-label>

                <x-input type="text" name="name" value="{{old('name')}}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Ingrese el  de nombre de contacto"/>
             </div>

             <div class="mb-4">
                <x-label>
                    Correo
                </x-label>

                <x-input type="email" name="email" value="{{old('email')}}"  class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Ingrese el correo de contacto"/>
             </div>

             <div class="mb-4">
                <x-label>
                    Mensaje
                </x-label>
                <div class="mb-4">


                <textarea name="message"  cols="30" rows="4"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Ingrese el correo de contacto" placeholder="Ingrese el mensaje" value="{{old('message')}}"></textarea>
             </div>


             <div class="flex justify-end">
                <x-button>Enviar</x-button>

             </div>

             <x-label>
                Cargar archivo
            </x-label>

        <input type="file" name="file" class="w-full"/>

         </div>


            </form>

        </div>


    </section>

  </x-app-layout>
