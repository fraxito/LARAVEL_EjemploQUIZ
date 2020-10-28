@extends('layouts.ejemplolayout')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-3">
            <h1 id="marcador"></h1>
        </div>
        <div id="preguntas" class="col-6">
        
        </div>
        <div class="col-3">
        
        </div>
    </div>
</div>
<script>
var pregunta = @json($pregunta)

    $('#marcador').html('{{$marcador}}');

    $('#preguntas').append('<button class="btn btn-block btn-dark disabled">'+pregunta[0].enunciado+' </button><br><br>');
    $('#preguntas').append('<button id="1" class="btn btn-block btn-primary " onclick="chequeaRespuesta(1)">'+pregunta[0].r1+' </button><br><br>');
    $('#preguntas').append('<button id="2" class="btn btn-block btn-primary " onclick="chequeaRespuesta(2)">'+pregunta[0].r2+' </button><br><br>'); 
    $('#preguntas').append('<button id="3" class="btn btn-block btn-primary " onclick="chequeaRespuesta(3)">'+pregunta[0].r3+' </button><br><br>'); 
    $('#preguntas').append('<button id="4" class="btn btn-block btn-primary " onclick="chequeaRespuesta(4)">'+pregunta[0].r4+'  </button><br><br>');   

function chequeaRespuesta(_respuesta){
    $('button').addClass('disabled').prop("onclick", null);
    if (_respuesta == pregunta[0].correcta ){ 
        $('#'+_respuesta).removeClass('btn-primary').addClass('btn-success');
        $('#preguntas').append('<button class="btn btn-block btn-warning " onclick="sigue()"> PREGUNTA SIGUIENTE  </button><br><br>');   
    }
    else{
        $('#'+_respuesta).removeClass('btn-primary').addClass('btn-danger');
        $('#'+ pregunta[0].correcta).removeClass('btn-primary').addClass('btn-success');
        $('#preguntas').append('<button class="btn btn-block btn-dark " onclick="pierde()"> PREGUNTA SIGUIENTE  </button><br><br>');   

    }
    
}
function pierde(){
    window.location.replace(href="{{ url('pregunta', [$tema, $marcador]) }}");
}
function sigue(){
    window.location.replace(href="{{ url('pregunta', [$tema, ($marcador=$marcador+1)]) }}");
}
</script>