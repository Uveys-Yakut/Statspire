<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('head')
        <link rel="stylesheet" href="{{ asset('css/variable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/docs/footer.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        @livewireStyles
    </head>
    <body>
        <div class="mn_wrpr">
            @livewire('docs.header')
            {{ $slot }}
            <footer>
                @livewire('docs.footer')
            </footer>
        </div>
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
    </body>
</html>
