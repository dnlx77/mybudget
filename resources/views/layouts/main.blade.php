<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
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
                    <h3><a href="{{ route('dashboard1', array($year, $mese, $tag1, '0')) }}"><span class="conto">Tutti i conti</span></a> <span class="conteggio"><em>{{ $totale_conti}} <b>€</b></em></span><br></h3>
                    <ul>
                        @foreach ($conti as $conto => $conteggio)
                            <li><a href="{{ route('dashboard1', array($year, $mese, $tag1, $conto)) }}"><span class="conto">{{ $conteggio[0] }}</span></a> <span class="conteggio"><em>{{ $conteggio[1]}} <b>€</b></em></span></li>
                        @endforeach
                    </ul>
                    <div>
                        <div class="row">
                            <div class="col-8">
                                <h3>Tags</h3>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary modale-tag" data-bs-toggle="modal" data-bs-target="#tagsModal">Aggiungi tag</button>
                                @include('dashboard.modal.insert')
                                @include('dashboard.modal.edit')
                            </div>
                        </div>
                        <ul>
                            <a href="{{ route('dashboard1', array($year, $mese, '0', $conto1)) }}"><li>Tutti i tags</li></a>
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ route('dashboard1', array($year, $mese, $tag->id, $conto1)) }}">{{ $tag->nome }}</a>
                                    <a data-bs-target="#tagsEditModal" class="modale-tag-edit" data-bs-toggle="modal" data-id-tag="{{ $tag->id }}" href="#tagsEditModal"><i class="bi bi-pencil"></i></a>
                                </li>
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