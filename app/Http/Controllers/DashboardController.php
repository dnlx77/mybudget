<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conto;
use App\Models\operazione;
use App\Models\tag;

class DashboardController extends Controller
{
    public function index() {
        return redirect()->route('dashboard1', array(Date("Y"), Date("m"), 0, 0));
    }

    public function index1($anno = 0, $mese = 0, $tag = 0, $conto_vis = 0) {
        $spesa = 0;
        $guadagno = 0;
        $anni = [];
        $conti = Conto::all();
        $primo_anno = date("Y", strtotime(operazione::min('data_operazione')));
        $ultimo_anno = date("Y", strtotime(operazione::max('data_operazione')));
        for ($i=$primo_anno; $i<=$ultimo_anno; $i++)
            $anni[$i] = $i;
        
        $totale_conti = round(operazione::all()->sum('importo'), 2);
        foreach ($conti as $conto) {
            $array_conti[$conto->id] = array($conto->nome, $conto->operazioni()->sum('importo'));
        }

        if(!$anno && !$mese && !$tag && !$conto_vis){
            $operazioni = operazione::all();
            foreach ($operazioni as $operazione) {
                if ($operazione->importo > 0 && $operazione->trasferimento == 'N')
                    $guadagno += $operazione->importo;
                else if ($operazione->importo < 0 && $operazione->trasferimento == 'N')
                    $spesa += abs($operazione->importo);
            }
            $operazioni = operazione::orderBy('data_operazione', 'desc')->orderBy('id', 'desc')->paginate(50);
        }
        else {
            $operazioni = operazione::CercaOperazioniAvanzato($anno, $mese, 0, $tag, $conto_vis)->get();
            foreach ($operazioni as $operazione) {
                if ($operazione->importo > 0 && $operazione->trasferimento == 'N')
                    $guadagno += $operazione->importo;
                else if ($operazione->importo < 0 && $operazione->trasferimento == 'N')
                    $spesa += abs($operazione->importo);

                if ($operazione->importo > 0 && $operazione->trasferimento == 'T' && $conto_vis)
                    $guadagno += $operazione->importo;

                if ($operazione->importo < 0 && $operazione->trasferimento == 'T' && $conto_vis)
                    $spesa += abs($operazione->importo);
            }
            $operazioni = operazione::CercaOperazioniAvanzato($anno, $mese, 0, $tag, $conto_vis)->orderBy('data_operazione', 'desc')->orderBy('id', 'desc')->paginate(50);
        }
        
        $saldo = round($guadagno - $spesa ,2);
        $tags = Tag::orderBy('nome','asc')->get();
        return view ('dashboard.index', [
            'totale_conti' => $totale_conti,
            'conti' => $array_conti,
            'elenco_conti' => $conti,
            'tags' => $tags,
            'operazioni' => $operazioni,
            'guadagno' => $guadagno,
            'spesa' => $spesa,
            'saldo' => $saldo,
            'lista_conti' => $conti,
            'anni' => $anni,
            'year' => $anno,
            'anno' => $anno,
            'mese' => $mese,
            'tag' => $tag,
            'tag1' => $tag,
            'conto' => $conto_vis,
            'conto1' => $conto_vis]);
    }

    public function getSaldi($anno = 0, $mese = 0, $tag = 0, $conto_vis = 0) {
        $totale_conti = [];
        
        if ($mese != 0 && $anno != 0){
            $giorni = cal_days_in_month(CAL_GREGORIAN, $mese, $anno);

            for($i=1; $i<=$giorni; $i++){
                $data=$anno.'-'.$mese.'-'.$i;
                $totale_conti[$i]=round(operazione::CercaOperazioniPrimaDi($data, $conto_vis, $tag)->sum('importo'), 2);
            }
        } 

        if ($mese == 0 && $anno != 0)
        {
            for($i=1; $i<13; $i++){
                $data=$anno.'-'.$i.'-'.'31';
                $totale_conti[$i]=round(operazione::CercaOperazioniPrimaDi($data, $conto_vis, $tag)->sum('importo'), 2);
            }
        }

        if ($anno == 0 && $mese == 0){
            $primo_anno = date("Y", strtotime(operazione::min('data_operazione')));
            $ultimo_anno = date("Y", strtotime(operazione::max('data_operazione')));
            for($i=$primo_anno; $i<=$ultimo_anno; $i++){
                $data=$i.'-'.'12'.'-'.'31';
                $totale_conti[$i]=round(operazione::CercaOperazioniPrimaDi($data, $conto_vis, $tag)->sum('importo'), 2);
            }
        }

        return json_encode($totale_conti);
    }   
}
