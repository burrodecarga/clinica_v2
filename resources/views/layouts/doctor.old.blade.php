<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Fontawensome css-->
        {{-- <link rel="stylesheet" href="{{ asset('css/all.min.css') }}"> --}}
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

        @vite(['resources/css/app.css', 'resources/js/app.js'])


        @livewireStyles

        @stack('styles')


        <!-- Scripts -->
         <!-- Fontawensome js-->
        {{-- <script src="{{ asset('js/all.min.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script> --}}
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
           <x-menu-doctor-nav/>
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <x-flash-messages/>
                
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('script')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
              ///Session Flash auto close
              setTimeout(function() {
                    $('#alert').remove()
                }, 3000)

        </script>


    </body>
</html>
