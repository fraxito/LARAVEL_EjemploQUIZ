<!-- Stored in resources/views/pagina01.blade.php -->

@extends('layouts.ejemplolayout')

@section('titulo', 'Página 01 del proyecto')

@section('barralateral')
    @parent

    <p>Esta parte se añade a la barra lateral original (no la sobreescribe). Pertenece a la página 01</p>
@endsection

@section('contenido')
    <h2>Este es el body de la página 01.</h2>
    <a href="{{ url('pagina02') }}" class="btn btn-xs btn-info pull-right">página 02</a>
@endsection