<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use Illuminate\Http\Request;

class apuntesController extends Controller
{





    public function store(){

        request()->validate([
            'imagen' => 'image'
        ]);

       $ruta = request('imagen')->store('public');

        Apunte::create([
            'titulo' =>request('titulo'),
            'explicacion' => request('explicacion'),
            'imagen' => $ruta,
            'link' => request('link')
        ]);

        return redirect()->route('inicio');
    }






    public function index(){
        
        $apunte= Apunte::latest()->simplePaginate();

        return view('inicio', compact('apunte'));
    }



    
    public function show($id){

        $apunte = Apunte::find($id);
        $pasos = Apunte::find($id)->pasos;
        $comentarios = Apunte::find($id)->comments;



        return view('apunte', compact('apunte'), compact('pasos', 'comentarios'));

    }



    


    public function edit(Apunte $apunte){
        return view('editar', compact('apunte'));
    }


    public function update(Apunte $apunte){
     
        request()->validate([
            'imagen' => 'image'
        ]);

        if(request('imagen')!= null){

            $ruta = request('imagen')->store('public');
            $apunte->update([
                'titulo' => request('titulo'),
                'explicacion' => request('explicacion'),
                'imagen' => $ruta
            ]);

        }
        else{
        
        $apunte->update([
            'titulo' => request('titulo'),
            'explicacion' => request('explicacion'),
            'imagen' => $apunte->imagen
        ]);

    }

        return redirect()->route('inicio')->with('mensaje', 'Apunte actualizado');

    }

    public function destroy(Apunte $apunte){

        $apunte->delete();


        return redirect()->route('inicio')->with('eliminado', 'Apunte Eliminado');

    }
}
