@extends('layouts.ejemplolayout')
<style>
button{
    /*la separación entre los botones*/
    margin: 10 0 10 0 !important;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-3">

        </div>
        <div id="preguntas" class="col-6">
       
        </div>
        <div class="col-3">
        
        </div>
    </div>
</div>
<script>

var pregunta = @json($pregunta);
var correcta = pregunta[0].correcta;

  $('#preguntas').append('<button class="btn btn-block btn-dark disabled"> {{$pregunta[0]->enunciado}} </button>');
  $('#preguntas').append('<button id="1" class="btn btn-block btn-primary " onclick="chequeaRespuesta(1)"> '+pregunta[0].r1+' </button>');
  $('#preguntas').append('<button id="2" class="btn btn-block btn-primary " onclick="chequeaRespuesta(2)"> '+pregunta[0].r2+' </button>'); 
  $('#preguntas').append('<button id="3" class="btn btn-block btn-primary " onclick="chequeaRespuesta(3)"> '+pregunta[0].r3+' </button>'); 
  $('#preguntas').append('<button id="4" class="btn btn-block btn-primary " onclick="chequeaRespuesta(4)"> '+pregunta[0].r4+' </button>');   

function chequeaRespuesta(_respuesta){
    //deshabilito todos los botones para que no se pueda seguir pinchando en ellos
    $('button').addClass("disabled").prop("onclick", null);
    //chequea si el número de la respuesta es el correcto
    if (_respuesta == correcta){
        $('#'+_respuesta).removeClass('btn-primary').addClass('btn-success');
    }
    else{
        //a la que he pinchado, la cambio a rojo
        $('#'+_respuesta).removeClass('btn-primary').addClass('btn-danger');
        //y pongo en verde la que era correcta
        $('#'+correcta).removeClass('btn-primary').addClass('btn-success');
    }
    //en cualquier caso, añado un botón para que cargue otra pregunta. Esto habría que ponerlo en el if de antes, y cambiarlo 
    //para que te lleve al final de la partida si no es correcto y se te han acabado las vidas
    $('#preguntas').append('<button  class="btn btn-block btn-dark " onclick="sigue({{$marcador}})"> SIGUIENTE PREGUNTA </button>');  
}


function sigue(_marcador){
    {{$marcador++}}
    window.location.replace(href="{{ url('pregunta', ['Historia',$marcador]) }}");
    // para ocultar el valor del marcador y que no aparezca en la URL, se usa Crypt::encrypt($marcador)
    //en el controlador se usa Crypt::decrypt
}

</script>



