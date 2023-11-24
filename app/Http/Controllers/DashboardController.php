<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conto;
use App\Models\operazione;
use App\Models\tag;

class DashboardController extends Controller
{
    public function index() {
        $conti = Conto::all();
        
        $totale_conti = round(operazione::all()->sum('importo') ,2);
        foreach ($conti as $conto) {
            $array_conti[$conto->nome] = $conto->operazioni()->sum('importo');
        }

        $operazioni = operazione::orderBy('data_operazione', 'desc')->paginate(20);

        $tags = Tag::orderBy('nome','asc')->get();
        return view ('dashboard.index', [
            'totale_conti' => $totale_conti,
            'conti' => $array_conti,
            'tags' => $tags,
            'operazioni' => $operazioni]);
    }
    
}
