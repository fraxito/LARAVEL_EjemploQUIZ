@extends('layouts.ejemplolayout')

@section('titulo', 'Página 01 del proyecto')


@section('barralateral')
   
    <p> Esta parte está en la barra lateral</p>
@endsection



@section('contenido')
    <p> Este está en el body</p>
    
    <a href="{{ url('pregunta', ['Historia',0]) }}" class="btn btn-xs btn-info pull-rigth">HISTORIA </a>
    <!-- //y aquí se pondría Crypt::encrypt(0) -->
    <a href="{{ url('pregunta', ['Economia',0]) }}" class="btn btn-xs btn-info pull-rigth">ECONOMIA </a>
    <a href="{{ url('pregunta', ['Ingles',0]) }}" class="btn btn-xs btn-info pull-rigth">Ingles </a>
    <a href="{{ url('api/preguntas', ['Historia']) }}" class="btn btn-xs btn-info pull-rigth">Historia pero un json solo </a>
    
    
  
@endsection