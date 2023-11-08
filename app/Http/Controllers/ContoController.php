<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conto;
use App\Models\operazione;

class ContoController extends Controller
{
    public function index() {
        $conti = Conto::all();
        $array_conti['Tutti i conti'] = round(operazione::all()->sum('importo') ,2);
        foreach ($conti as $conto) {

            $array_conti[$conto->nome] = $conto->operazioni()->sum('importo');
        }
        return view ('conti.index', ['conti' => $array_conti]);
    }
    
}
