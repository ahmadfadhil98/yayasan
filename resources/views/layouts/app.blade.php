<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <style>
            .badge {
                display: inline-block;
                position: absolute;
                top: 0;
                background-color: #4285f4;
                color: #d7e6fd;
                right: 0;
                border-radius: 9999px;
                font-size: 12px;
                min-width: 18px;
                line-height: 18px;
                min-height: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div  class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>


        </div>

        @stack('modals')

        @livewireScripts
    </body>
    {{-- <footer class="bg-gradient-to-r from-green-600 to-green-900 shadow-inner">
        <div class="text-xs text-gray-200 text-center py-3.5">
            <div class="">Sistem Informasi S3 Pertanian</div>
            <div class="">Universitas Andalas</div>
            </div>
        </div>
    </footer> --}}
</html>
