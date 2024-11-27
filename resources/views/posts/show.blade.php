<x-app-layout>
    <section class="mt-4 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg shadow-lg">
        <!-- Tags -->
        <div class="mb-6 flex flex-wrap gap-2">
            @foreach ($post->tags as $tag)
                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-200 transition transform hover:scale-105 duration-200">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-4 hover:text-blue-600 transition duration-200">
            {!! $post->title !!}
            
        </h1>

        <!-- Meta Information -->
        <div class="text-sm text-gray-500 mb-6">
            <span>{{ $post->published_at->format('d M Y') }}</span>
            <span class="mx-2">|</span>
            <span>{{ $post->user->name }}</span>
        </div>

        <!-- Post Image -->
        <figure class="mb-8">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="aspect-video object-cover object-center w-full rounded-lg shadow-lg transition transform hover:scale-105 duration-300">
        </figure>

        <!-- Excerpt -->
        <div class="prose max-w-none mb-6 text-gray-700">
            {!! $post->excerpt !!}
        </div>

        <!-- Body Content -->
        <div class="prose max-w-none text-gray-900 leading-relaxed mb-6">
            {{-- {!! nl2br(e($post->body)) !!} --}}

            <p id="summernote1"> {!!$post->body !!}</p> 
        </div>

        <!-- Comments Section -->
        <div class="mt-16">
            @livewire('question', ['model' => $post])
        </div>

        <!-- Botón para volver a la lista -->
        <div class="mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-black hover:black rounded-lg transition duration-200">
                <i class="fas fa-reply mr-1"></i> Volver a Publicaciones
            </a>
        </div>
        {{-- @push('css') --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.min.css" rel="stylesheet">
        <!-- Agregar tema adicional si lo prefieres -->
        <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-okaidia.min.css" rel="stylesheet">
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css"> --}}
    {{-- @endpush
    
    @push('js') --}}
    
        {{-- <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-java.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-python.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-php.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-javascript.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-css.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-html.min.js"></script> --}}
        
        {{-- <script>
            
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300, // Altura del editor
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                        ['misc', ['code']] // Añade el botón para insertar código
                    ],
                    
        
                });
            });
            // ['view', ['fullscreen', 'codeview', 'help']],
        </script> --}}
    {{-- @endpush --}}
    
     
    </section>
</x-app-layout>
