<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
       <!-- fontawesome -->
       <script src="https://kit.fontawesome.com/83af161d9e.js" crossorigin="anonymous"></script>
         <!-- fontawesome -->
        <!-- Scripts -->
        {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
            <!-- Otros elementos -->
            <script src="https://cdn.jsdelivr.net/npm/livewire-v2.0.0/dist/livewire.js" data-turbo-track="reload"></script>
           
       
        
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts


    </body>
</html>
