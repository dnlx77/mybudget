<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conto;
use App\Models\operazione;
use App\Models\tag;

class DashboardController extends Controller
{
    public function index($anno = null, $mese = null, $tag = null) {
        $spesa = 0;
        $guadagno = 0;
        $conti = Conto::all();
        
        $totale_conti = round(operazione::all()->sum('importo') ,2);
        foreach ($conti as $conto) {
            $array_conti[$conto->nome] = $conto->operazioni()->sum('importo');
        }

        if(!$anno && !$mese && !$tag){
            $operazioni = operazione::all();
            foreach ($operazioni as $operazione) {
                if ($operazione->importo > 0)
                    $guadagno += $operazione->importo;
                else
                    $spesa += abs($operazione->importo);
            }
            $operazioni = operazione::orderBy('id', 'desc')->paginate(50);
        }
        else {
            $operazioni = operazione::CercaOperazioniAvanzato($anno, $mese, $tag)->get();
            foreach ($operazioni as $operazione) {
                if ($operazione->importo > 0)
                    $guadagno += $operazione->importo;
                else
                    $spesa += abs($operazione->importo);
            }
            $operazioni = operazione::CercaOperazioniAvanzato($anno, $mese, $tag)->orderBy('id', 'desc')->paginate(50);
        }
        
        $saldo = round($guadagno - $spesa ,2);

        $tags = Tag::orderBy('nome','asc')->get();
        return view ('dashboard.index', [
            'totale_conti' => $totale_conti,
            'conti' => $array_conti,
            'tags' => $tags,
            'operazioni' => $operazioni,
            'guadagno' => $guadagno,
            'spesa' => $spesa,
            'saldo' => $saldo,
            'lista_conti' => $conti]);
    }
    
}
