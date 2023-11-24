@extends('layouts.main')
@section('dashboard_content')
    
<body>
    <div class="col-9 text-center">
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
</body>
</html>

@endsection