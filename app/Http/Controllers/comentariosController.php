<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class comentariosController extends Controller
{

    public function store(){
        Comment::create([
            'comentario' => request('comentario'),
            'nombre' => 'Anonimo',
            'apunte_id' => request('apunte_id')
        ]);

    return redirect()->route('apunte.show', request('apunte_id'))->with('Comentario agregado');

    
    }
}
