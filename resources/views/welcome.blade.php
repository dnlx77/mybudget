<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

  

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

  

    <title>{{ config('app.name', 'Laravel') }}</title>

  

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  

    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  

    <script type="module">

  

        $('.datepicker').datepicker();

  

    </script>

  

</head>

<body>

    <div id="app">

  

        <main class="container">

            <h1> How to Install JQuery UI in Laravel? - ItSolutionstuiff.com</h1>

  

            <input type="text" class="datepicker" name="date" autocomplete="false">

              

            <button class="btn btn-success">Click Me</button>

        </main>

    </div>

  

</body>

</html>