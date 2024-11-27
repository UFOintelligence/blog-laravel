<x-admin-layout :breadcrumb="[
    [
'name' => 'Home',
'url'  => route('admin.dashboard'),

],
[
'name' => 'Articulos',
'url'  => route('admin.posts.index'),

],
[
'name' => 'Editar',

]

]">

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">


        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <div class="mb-6 relative">
            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $post->image }}" alt="no imagen"
                    id="imgPreview">
            </figure>

            <div class="absolute top-8 right-8">

                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">

                    <i class="fa-solid fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" accept="image/*" name="image" class="hidden"
                        onchange="previewImage(event, '#imgPreview')">

                </label>

            </div>
        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Titulo
            </x-label>

            <x-input class="w-full" placeholder="Escriba el titulo del post" name="title"
                value="{{ old('title', $post->title ) }}"></x-input>
        </div>


          {{-- input oculto --}}

            <x-input  type="hidden" class="w-full" placeholder="slug" name="slug" value="{{ old('slug', $post->slug) }}"></x-input>
        </div>


        <div class="mb-4">

            <x-label>
                Categoria
            </x-label>

            <x-select class="w-full" name="category_id">

                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>

        </div>



        <div class="mb-4">
            <x-label class="mb-1">
                Resumen
            </x-label>
            <x-textarea class="summernote w-full" name="excerpt"> {{ old('excerpt', $post->excerpt) }} </x-textarea>
        </div>


        <div class="mb-4">
            <x-label class="mb-1">
                Etiquetas
            </x-label>

            <select class="tag-multiple" name="tags[]" multiple="multiple" style="width: 100%">

                @foreach ($post->tags as $tag)
               <option value="{{ $tag->name }}" selected>
                {{ $tag->name }}
            </option>
               @endforeach


            </select>


        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Cuerpo
            </x-label>
            <x-textarea  class="summernote w-full" rows="12" name="body" id="summernote"> {{ old('body', $post->body) }}
            </x-textarea>

        </div>

        <div class="mb-4">
            <input name="published" type="hidden" value="0">

            <label class="inline-flex items-center cursor-pointer">
                <input name="published" type="checkbox" value="1" class="sr-only peer"
                    @checked(old('published', $post->published) == 1)>
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
            </label>


        </div>


        <div class="flex justify-end">
            <x-danger-button type="button" class="mr-2" onclick="deletePost()">
                Eliminar
            </x-danger-button>

            <x-button>Actualizar</x-button>
        </div>


    </form>


    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>

    @push('js')
       
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     {{-- editor summernote --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
       

<!-- include libraries(jQuery, bootstrap) -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

<!-- include summernote css/js-->
{{-- <link href="summernote.css">
<script src="summernote.js"></script> --}}




        <script>
            $(document).ready(function() {
                $('.tag-multiple').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{route('api.tags.index')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params){

                            return {
                         $term: params.term

                       }

                        },
                        processResults: function(data) {
                           return {
                                results: data
                            }
                        },
                    }
                });
            });



            function deletePost() {

                let form = document.getElementById('formDelete');
                form.submit();

            }


            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }

           
      
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300, // Altura del editor
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'help']]
                 ['misc', ['code']] // Añade el botón para insertar código
            ]

        });
    });

    $('.summernote').summernote({
  height: 150, //set editable area's height
  codemirror: { // codemirror options
    theme: 'monokai'
  }
});
</script>


    @endpush

</x-admin-layout>
