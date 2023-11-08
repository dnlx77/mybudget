@extends('layouts.main')
@section('content')
    
<body>
    <div class="table-container">
        <table class="table table-hover table-bordered">
            </body>
                @foreach ($conti as $conto => $conteggio)
                    <tr>
                        <td>{{ $conto }} {{ $conteggio}}<br></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection