<?php

namespace App\Http\Controllers;

use App\Models\Conto;
use App\Models\Operazione;
use App\Models\relOperazioneTag;
use Illuminate\Http\Request;

class OperazioneController extends Controller
{
    public function insert(Request $request) {

        // Verifica che i conti appartengano all'utente (il global scope filtra per user_id)
        Conto::findOrFail($request->get('conto_partenza'));
        if($request->get('conto_destinazione'))
            Conto::findOrFail($request->get('conto_destinazione'));

        $operazione = new Operazione();
        $operazione->data_operazione = \DateTime::createFromFormat('Y-m-d', $request->get('data_operazione'));
        $operazione->importo = $request->get('importo');
        $operazione->descrizione = $request->get('descrizione');
        $operazione->conto_id = $request->get('conto_partenza');
        if($request->get('conto_destinazione'))
            $operazione->trasferimento='T';
        else
            $operazione->trasferimento='N';
        $operazione->save();

        foreach($request->get('tags') as $tag) {
            $relOperazioneTag = new relOperazioneTag();
            $relOperazioneTag->operazione_id = $operazione->id;
            $relOperazioneTag->tag_id = $tag;
            $relOperazioneTag->save();
        }

        if($request->get('conto_destinazione')) {
            $operazione = new Operazione();
            $operazione->data_operazione = \DateTime::createFromFormat('Y-m-d', $request->get('data_operazione'));
            $operazione->importo = $request->get('importo')*(-1);
            $operazione->descrizione = $request->get('descrizione');
            $operazione->conto_id = $request->get('conto_destinazione');
            $operazione->trasferimento='T';
            $operazione->save();

            foreach($request->get('tags') as $tag) {
                $relOperazioneTag = new relOperazioneTag();
                $relOperazioneTag->operazione_id = $operazione->id;
                $relOperazioneTag->tag_id = $tag;
                $relOperazioneTag->save();
            }
        }

        return redirect(route('dashboard'))->with('success', 'Operazione inserita');
    }

    public function getOperazione ($operazione_id) {

        $operazione = Operazione::findOrFail($operazione_id);
        $tags = $operazione->tags;
        $tags_array =[];
        foreach ($tags as $tag)
            $tags_array[] = $tag->id;

        return response()->json(['operazione' => $operazione, 'tags' => $tags_array]);
    }

    public function edit (Request $request) {
        $operazione = Operazione::findOrFail($request->edit_operazione_id);
        Conto::findOrFail($request->get('conto_partenza'));
        $operazione->data_operazione = \DateTime::createFromFormat('Y-m-d', $request->get('data_operazione'));
        $operazione->importo = $request->get('importo');
        $operazione->descrizione = $request->get('descrizione');
        $operazione->conto_id = $request->get('conto_partenza');
        $operazione->tags()->sync($request->get('tags'));
        $operazione->save();

        return redirect(route('dashboard'))->with('success', 'Operazione aggiornata');
    }

    public function delete ($operazione_id) {
        $operazione = Operazione::findOrFail($operazione_id);
        $operazione->delete();

        return redirect(route('dashboard'))->with('success', 'Operazione aggiornata');
    }
}

    
