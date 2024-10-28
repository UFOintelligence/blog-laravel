<x-app-layout>

    <figure class="mb-12">

        <img src="{{ asset('img/home/banner.jpg') }}"
        class="w-full  aspect-[3/1] object-cover object-center"
         >

    </figure>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-3xl text-center font-semibold mb-4">
            Lista de articulos
        </h1>

       <div class="space-y-8 mt-8">

        @foreach ($posts as $post)
        <article class="grid grid-cols-2 gap-6">
          <div>
            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full rounded-lg" src="{{ $post->image}}">
            </figure>
          </div>

            <div class="">
                <h1 class="text-xl text-center font-semibold">
                    {{$post->title}}

                </h1>
                <hr class="mt-1 mb-2">
                <div class="mb-2">
                     @foreach ($post->tags as $tag )

                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold mr-2 px-2">
                        {{ $tag->name }}
                    </span>

                    @endforeach

                </div>

                <p class="text-sm mb-2">
                 {{ $post->published_at->format('d M Y') }}
                </p>

                <div class="mb-8">

                    {{  Str::limit($post->excerpt, 100)}}
                </div>
                {{-- {{route('posts.show', $post)}} --}}
                <div>
                    <a href="" class="text-white bg-blue-700
             hover:bg-blue-800 focus:outline-none focus:ring-4
              focus:ring-blue-300 font-medium rounded-full text-sm px-5
               py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
             Leer más
            </a>
                </div>

            </div>


        </article>
    @endforeach
       </div>

       <div class="mt-4">
        {{$posts->links()}}

    </div>

    </section>


</x-app-layout>
