<?php

namespace App\Http\Controllers;

use App\Models\Paso;
use Illuminate\Http\Request;

class pasosController extends Controller
{



    public function store(){

        request()->validate([
            'imagen' => 'image'
        ]);
       
        $rutaImagen = request('imagen')->store('public');

        Paso::create([
            'titulo' => request('titulo'),
            'descripcion' => request('descripcion'),
            'imagen' => $rutaImagen,
            'apunte_id' =>request('apunte_id')
        ]);

        return redirect()->route('apunte.show',request('apunte_id'))->with('mensaje','Paso agregado');


        
    }



}
