@extends('layouts.main')
@section('dashboard_content')
    
<body>
    <div class="col-9 text-center"> 
        <div class="row">
            <div class="col-9">
                    <ul class="main-menu">
                        <a href="{{ route('dashboard1', array($anno, '0', $tag, $conto)) }}"><li>Anno</li></a>
                        <a href="{{ route('dashboard1', array($anno, '1', $tag, $conto)) }}"><li>Gen</li></a>
                        <a href="{{ route('dashboard1', array($anno, '2', $tag, $conto)) }}"><li>Feb</li></a>
                        <a href="{{ route('dashboard1', array($anno, '3', $tag, $conto)) }}"><li>Mar</li></a>
                        <a href="{{ route('dashboard1', array($anno, '4', $tag, $conto)) }}"><li>Apr</li></a>
                        <a href="{{ route('dashboard1', array($anno, '5', $tag, $conto)) }}"><li>Mag</li></a>
                        <a href="{{ route('dashboard1', array($anno, '6', $tag, $conto)) }}"><li>Giu</li></a>
                        <a href="{{ route('dashboard1', array($anno, '7', $tag, $conto)) }}"><li>Lug</li></a>
                        <a href="{{ route('dashboard1', array($anno, '8', $tag, $conto)) }}"><li>Ago</li></a>
                        <a href="{{ route('dashboard1', array($anno, '9', $tag, $conto)) }}"><li>Set</li></a>
                        <a href="{{ route('dashboard1', array($anno, '10', $tag, $conto)) }}"><li>Ott</li></a>
                        <a href="{{ route('dashboard1', array($anno, '11', $tag, $conto)) }}"><li>Nov</li></a>
                        <a href="{{ route('dashboard1', array($anno, '12', $tag, $conto)) }}"><li>Dic</li></a>
                        <li>
                            <select name="anni" id="anno-select">
                                @foreach ($anni as $anno)
                                    <option value="{{$anno}}">{{ $anno }}</option>
                                @endforeach
                            </select>
                        </li>
                </ul>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary modale-operazione" data-bs-toggle="modal" data-bs-target="#operazioniModal">Aggiungi</button>
                @include('operazioni.modal.insert')
            </div>
        </div>
        <div class="row">
            <div class="col-4"><h3>Guadagno {{ $guadagno}} €</h3></div>
            <div class="col-4"><h3>Spesa {{ $spesa }} €</h3></div>
            <div class="col-4"><h3>Saldo {{ $saldo }} €</h3></div>
        </div>
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Conto</th>
                        <th>Tags</th>
                        <th>Descrizione</th>
                        <th>Importo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operazioni AS $operazione)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($operazione->data_operazione)) }}</td>
                            <td>{{ $operazione->conto->nome }}</td>
                            <td><ul>
                                @foreach ($operazione->tags AS $tag)
                                    <li>{{ $tag->nome }}</li>    
                                @endforeach
                            </ul></td>
                            <td>{{ $operazione->descrizione }}</td>
                            <td>{{ $operazione->importo }}<em>€</em></td>
                            <td><a data-bs-target="#operazioniEditModal" class="modale-edit" data-bs-toggle="modal" data-id-operazione="{{ $operazione->id }}" href="#operazioniEditModal">modifica</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @include('operazioni.modal.edit')
        </div>
        {{ $operazioni->links() }}
    </div>

</body>

<script type="module">
    $(document).ready(function() {
        
        var pathname = window.location.pathname;
        var urlsegment = pathname.split("/");
        var anno = urlsegment[2]
        var mese = urlsegment[3];
        var tag = urlsegment[4];
        var cont = urlsegment[5];
        
       
        $('#anno-select').val(anno);
        
        $('#anno-select').on('change', function() {
            var selVal=$(this).val();
            window.location.href = "{{ route('dashboard1', '') }}" + "/" + selVal + "/" + mese + "/" + tag + "/" + cont;
            
            /* La riga sotto è equivalente a quella sopra ma quella soptra è più leggibile */
            //window.location.href=selVal;
        });

    });
</script>

</html>

@endsection