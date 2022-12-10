<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <title>Laravel</title>
    </head>
    <body>
        <main>
            <div class="container">
                @include('components.header')
            </div>
            <h1 style="text-align: center;margin-top: 100px;">SISCAD</h1>
            <p style="text-align: center;opacity: .7;">Bem vindo ao sistema acadêmico.</p>
        </main>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
    </body>
</html>
