@extends('layouts.main')
@section('dashboard_content')
    
<body>
    <div class="col-9 text-center">
        <div class="row">
            <div class="col-9">

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
                            <td>{{ $operazione->data_operazione }}</td>
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
            @include('operazioni.modal.edit');
        </div>
        {{ $operazioni->links() }}
    </div>

</body>

</html>

@endsection