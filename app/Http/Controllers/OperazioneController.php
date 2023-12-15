<?php

namespace App\Http\Controllers;

use App\Models\Operazione;
use App\Models\relOperazioneTag;
use Illuminate\Http\Request;

class OperazioneController extends Controller
{
    public function insert(Request $request) {

        $operazione = new Operazione();
        $operazione->data_operazione = \DateTime::createFromFormat('d-m-Y', $request->get('data_operazione'));
        $operazione->importo = $request->get('importo');
        $operazione->descrizione = $request->get('descrizione');
        $operazione->conto_id = $request->get('conto_partenza');
        $operazione->save();

        foreach($request->get('tags') as $tag) {
            $relOperazioneTag = new relOperazioneTag();
            $relOperazioneTag->operazione_id = $operazione->id;
            $relOperazioneTag->tag_id = $tag;
            $relOperazioneTag->save();
        }

        if($request->get('conto_destinazione')) {
            $operazione = new Operazione();
            $operazione->data_operazione = \DateTime::createFromFormat('d-m-Y', $request->get('data_operazione'));
            $operazione->importo = $request->get('importo')*(-1);
            $operazione->descrizione = $request->get('descrizione');
            $operazione->conto_id = $request->get('conto_destinazione');
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

        $operazione = Operazione::find($operazione_id);
        $tags = $operazione->tags;
        $tags_array =[];
        foreach ($tags as $tag)
            $tags_array[] = $tag->id;

        return response()->json(['operazione' => $operazione, 'tags' => $tags_array]);
    }

    public function edit (Request $request) {
        $operazione = Operazione::find($request->edit_operazione_id);
        $operazione->data_operazione = \DateTime::createFromFormat('d-m-Y', $request->get('data_operazione'));
        $operazione->importo = $request->get('importo');
        $operazione->descrizione = $request->get('descrizione');
        $operazione->conto_id = $request->get('conto_partenza');
        $operazione->tags()->sync($request->get('tags'));
        $operazione->save();

        return redirect(route('dashboard'))->with('success', 'Operazione aggiornata');
    }
}

    
