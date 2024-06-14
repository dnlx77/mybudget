<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tag;

class TagController extends Controller
{
    public function insert(Request $request) {
        $tag = new Tag();
        $tag->nome = $request->get('insert-tag');
        $tag->save();

        return redirect(route('dashboard'))->with('success', 'Tag inserito');
    }

    public function edit(Request $request) {
        $tag = Tag::find($request->edit_tag_id);
        $tag->nome = $request->get('edit-tag');
        $tag->save();

        return redirect(route('dashboard'))->with('success', 'Tag aggiornato');
    }

    public function getTag ($tag_id) {

        $tag = Tag::find($tag_id);

        $arr = ['nome' => $tag->nome];
        return json_encode($arr);
    }

}
