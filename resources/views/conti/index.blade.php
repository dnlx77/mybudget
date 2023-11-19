@extends('layouts.main')
@section('conti_content')
    
<body>
    <div class="prova">
        <ul>
            @foreach ($conti as $conto => $conteggio)
                <li>{{ $conto }} <em>{{ $conteggio}}</em></li>
            @endforeach
        </ul>
    </div>
</body>
</html>

@endsection