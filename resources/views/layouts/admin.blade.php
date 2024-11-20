
@props([
    'breadcrumb' => [],
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/83af161d9e.js" crossorigin="anonymous"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
         <!-- Sweetalert2 -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
      

    </script>

        <!-- Styles -->
        @livewireStyles
        @stack('css')
              <!--summernote -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased sm:overflow-auto"
    :class="{'overflow-hidden': open}" x-data="{open: false}">

<x-banner/>


        @include('layouts.includes.admin.nav');
        @include('layouts.includes.admin.aside');


          <div class="p-4 sm:ml-64">

           <div class="mt-14 -mb-10 flex justify-between">
            @include('layouts.includes.admin.breadcrumb')

            @isset($action)

            {{$action}}

            @endisset
           </div>


             <div class="p-4 border-2 border-gray-200 border-dashed
             rounded-lg dark:border-gray-700 mt-14 ">

             {{ $slot }}

             </div>


          </div>



        </div>
        <div  x-show = "open"
        x-on:click = "open = false"
        class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30 "></div>



        @stack('modals')


        @livewireScripts

        @if (session ('swal'))

        <script>

            Swal.fire(@json(session('swal')));

            </script>


        @endif


  @stack('js')

    <!-- Incluye Summernote -->
 

    @push('js')
   
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    
    
    @endpush
  
  
    </body>

</html>

