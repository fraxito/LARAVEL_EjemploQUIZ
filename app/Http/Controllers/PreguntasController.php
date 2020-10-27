<?php

namespace App\Http\Controllers;
use App\Preguntas;

use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    public function devuelve_pregunta($tema){
       return Preguntas::where('tema', $tema)->inRandomOrder()->first();  
    }

    public function carga_pregunta($tema, $marcador){
        return view('pregunta')->with('pregunta', Preguntas::where('tema', $tema)->inRandomOrder()->limit(1)->get())
                               ->with('tema', $tema)
                               ->with('marcador',$marcador);
                               // se pondría ->with('marcador', \Crypt::decrypt($marcador) ); si estuviera encriptado
    }

}
