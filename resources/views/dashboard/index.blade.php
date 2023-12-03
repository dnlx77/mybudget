@extends('layouts.main')
@section('dashboard_content')
    
<body>
    <div class="col-9 text-center">
        <div class="row">
            <div class="col-9">

            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary modale-operazione" data-bs-toggle="modal" data-bs-target="#operazioniModal">Aggiungi</button>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operazioni AS $operazione)
                        <tr>
                            <td>{{ $operazione->data_operazione }}</td>
                            <td>{{ $operazione->conto->nome }}</td>
                            <td><ul>
                                @foreach ($operazione->tags AS $tag)
                                    <li>{{ $tag->nome }}</li>    
                                @endforeach
                            </ul></td>
                            <td>{{ $operazione->descrizione }}</td>
                            <td>{{ $operazione->importo }}<em>€</em></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $operazioni->links() }}
    </div>

    <!-- Modale inserimento operazioni -->
    <div class="modal fade" id="operazioniModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inserisci la data di lettura dell'albo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" action="">
                    <div class="modal-body">
                    
                        @csrf
                        <label for="data_lettura">Data operazione:</label>
                        <input type="text" class="form-control" name="data_operazione" value=""/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    
</body>

<script type="module">
    $(document).ready(function(){
        $('[name=data_operazione]').datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
</script>
</html>

@endsection