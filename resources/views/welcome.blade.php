
<script>
        var segundo = 1;
        var sigue = true; 
        var progress;
        var t = 2000;
     $(document).ready(function() {
        $("#usuario").text("Nivel "+ <?php echo json_encode($nivel); ?>+" "+<?php echo json_encode($usuario); ?>);
        var preg = ""+<?php echo json_encode($respuestasCorrectas); ?> ;
        if (preg === "1"){
            $("#marcador").text("pregunta correcta: " + preg + " de 10").off('click');
        }
        else {
            $("#marcador").text("preguntas correctas: " + preg + " de 10").off('click');
        }
        
        $("#barra").css('width',<?php echo json_encode($num_pregunta*10); ?>+'%');
        $("#sigue").hide();
        $("#sigueNivel").hide();
        $("#fin").hide();
        $("#user").show().click(function() {
             sigue = false;
             segundo = 0;
             $("#vidas1").hide(t); $("#vidas2").hide(t); $("#vidas3").hide(t);
             $("#tiempo").css('width','0%');
             $("#center").load("sesion.php",{p1:1,p2:"",vidas:3,correctas:0});
             $("#salirPartida").hide();
        });
        $("#salirPartida").show().click(function() {
             sigue = false;
             segundo = 0;
             $("#vidas1").hide(t); $("#vidas2").hide(t); $("#vidas3").hide(t);
             $("#tiempo").css('width','0%');
             $("#center").load("menu.php",{p1:1,p2:"",vidas:3,correctas:0});
             $("#salirPartida").hide();
          });
        var v = ""+<?php echo json_encode($numeroVidas); ?>;
        switch (v){
            case "0":{$("#vidas1").hide(t); $("#vidas2").hide(t); $("#vidas3").hide(t);};break;
            case "1":{$("#vidas1").show(t); $("#vidas2").hide(t); $("#vidas3").hide(t);};break;
            case "2":{$("#vidas1").show(t); $("#vidas2").show(t); $("#vidas3").hide(t);};break;    
            case "3":{$("#vidas1").show(t); $("#vidas2").show(t); $("#vidas3").show(t);};break;       
        }
            //temporizador de la barra        
            clearInterval(progress);
            progress = setInterval(function() {
                var $caja = $("#cajaTiempo");
                if ($("#tiempo").width() >= $caja.width()) {
                    clearInterval(progress);
                    segundo = 0;
                    inCorrecta();
                } else {
                    if(sigue){           
                        $("#tiempo").width($("#tiempo").width()+$caja.width()/10);
                       segundo++; 
                    } 
                }  
                if (segundo < 5){
                    $("#cajaTiempo").removeClass("progress-warning");
                    $("#cajaTiempo").removeClass("progress-danger");
                    $("#cajaTiempo").addClass("progress-success");
                } else if (segundo < 8){
                    $("#cajaTiempo").removeClass("progress-success");
                    $("#cajaTiempo").addClass("progress-warning");
                } else {
                    $("#cajaTiempo").removeClass("progress-warning");
                    $("#cajaTiempo").addClass("progress-danger");
                }               
                $("#tiempo").text(segundo);
            }, 3600);
     });  
    
    function correcta(respuesta){
        sigue = false;
        segundo = 0;
        $("#tiempo").css('width','0%');
        $("[id*='mal']").hide();
        $("#ok").removeClass("btn-primary").addClass("btn-success");
        var numCorrectas = ""+<?php echo json_encode($respuestasCorrectas+1); ?>;
        //con 10 respuestas correctas pasas de nivel
        if (numCorrectas < 10){
            $("#sigue").show(); 
            $("button").addClass("disabled").prop("onclick", null);
            $("#sigue").removeClass("disabled");
            $("#marcador").text("CORRECTO!");
        }
        else {
//            $("#marcador").text("BRAVO! Has superado este nivel!");
//            $("#sigueNivel").show();
            $("#center").load("final.php",{
                p1:<?php echo json_encode($num_pregunta+1); ?>,
                p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,
                tema:<?php echo json_encode($tema); ?>,
                vidas:<?php echo json_encode($numeroVidas); ?>,
                correctas:<?php echo json_encode($respuestasCorrectas+1); ?>,
                nivel:<?php echo json_encode($nivel); ?>
            });
        }
    };
    
    function inCorrecta(respuesta){
        sigue = false;
        segundo = 0;
        $("#tiempo").css('width','0%');
        $("[id*='mal']").hide();
        $("#fin").show(); 
        $("button").addClass("disabled").prop("onclick", null);
        $("#fin").removeClass("disabled");
        $("#ok").removeClass("btn-primary").addClass("btn-success");
        $("#marcador").text("LA RESPUESTA CORRECTA ES:");       
        var v = ""+<?php echo json_encode($numeroVidas-1); ?>;
        switch (v){
            case "0":{$("#vidas1").hide(t); $("#vidas2").hide(t); $("#vidas3").hide(t);};break;
            case "1":{$("#vidas1").show(t); $("#vidas2").hide(t); $("#vidas3").hide(t);};break;
            case "2":{$("#vidas1").show(t); $("#vidas2").show(t); $("#vidas3").hide(t);};break;    
            case "3":{$("#vidas1").show(t); $("#vidas2").show(t); $("#vidas3").show(t);};break;       
        }
    };
    
    function SiguePartida(){
        clearInterval(progress);
        sigue = true;
        $("#center").load("partida.php",{
            p1:<?php echo json_encode($num_pregunta+1); ?>,
            p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,
            tema:<?php echo json_encode($tema); ?>,
            vidas:<?php echo json_encode($numeroVidas); ?>,
            correctas:<?php echo json_encode($respuestasCorrectas+1); ?>,
            nivel:<?php echo json_encode($nivel); ?>
        });
    }; 
 
    function pasaNivel(){
        clearInterval(progress);
        sigue = true;
        var _tema = <?php echo json_encode($tema); ?>;
        switch (_tema){
            case "Historia":$("#center").load("menuTema.php",{p1:1,p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,vidas:3,correctas:0,tema:"Historia",nivelSube:<?php echo json_encode($nivel+1); ?>});break;
            case "Economia":$("#center").load("menuTema.php",{p1:1,p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,vidas:3,correctas:0,tema:"Economia",nivelSube:<?php echo json_encode($nivel+1); ?>});break;
            case "Filosofia":$("#center").load("menuTema.php",{p1:1,p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,vidas:3,correctas:0,tema:"Filosofia",nivelSube:<?php echo json_encode($nivel+1); ?>});break;
            case "Lengua":$("#center").load("menuTema.php",{p1:1,p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,vidas:3,correctas:0,tema:"Lengua",nivelSube:<?php echo json_encode($nivel+1); ?>});break;
            case "Ingles":$("#center").load("menuTema.php",{p1:1,p2:<?php echo json_encode($preguntas[$j][6].",".$preguntasPasadas); ?>,vidas:3,correctas:0,tema:"Ingles",nivelSube:<?php echo json_encode($nivel+1); ?>});break;
        }

    };
    
    function FinPartida(){
        _vidas = <?php echo json_encode($numeroVidas); ?> - 1;
        if (_vidas > 0){
            sigue = true;
            $("#center").load("partida.php",{
                p1:<?php echo json_encode($num_pregunta+1); ?>,
                p2:<?php echo json_encode($preguntasPasadas); ?>,
                tema:<?php echo json_encode($tema); ?>,
                vidas:_vidas,
                correctas:<?php echo json_encode($respuestasCorrectas); ?>,
                nivel:<?php echo json_encode($nivel); ?>
            }); 
        }
        else {
            $("#tiempo").text("");
            $("#center").load("final.php",{
                p1:<?php echo json_encode($respuestasCorrectas); ?>,
                tema:<?php echo json_encode($tema); ?>,
                nivel:<?php echo json_encode($nivel); ?>,
                correctas:<?php echo json_encode($respuestasCorrectas); ?>    
             }); 
        }
    };   
</script>