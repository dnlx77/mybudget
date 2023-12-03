<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    <!-- Fonts -->
    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <header class="container-fluid"></header>
    
    <div class="content-wrapper">  
        <div class="container-fluid"> 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <strong>{{  Session::get('success') }}</strong>
        </div>
        <div class="container-fluid">
            <div class="row row-height">
                <div class="col-3 sidebar">
                    <h3><span class="conto">Tutti i conti</span> <span class="conteggio"><em>{{ $totale_conti}} <b>€</b></em></span><br></h3>
                    <ul>
                        @foreach ($conti as $conto => $conteggio)
                            <li><span class="conto">{{ $conto }}</span> <span class="conteggio"><em>{{ $conteggio}} <b>€</b></em></span></li>
                        @endforeach
                    </ul>
                    <div>
                        <h3>Tags</h3><br>
                        <ul>
                            @foreach ($tags as $tag)
                                <li>{{ $tag->nome }}</li>
                            @endforeach
                    </div>
                </div>
                <div class="col-9 right">
                    @yield('dashboard_content')
                </div>
             </div>
        </div>   
    </div>
</body>
</html>