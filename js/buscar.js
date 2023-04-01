var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}

$(document).ready(function(){
    $('#1').click(function(){
        $("#contenido").load("1.1funcionamiento_general.html");
    });

    $('#1_2').click(function(){
        $("#contenido").load("1.2vl_simple.html");
    });

    $('#1_3').click(function(){
        $("#contenido").load("1.3vl_filtro.html");
    });

    $('#1_4').click(function(){
        $("#contenido").load("1.4ve_comunes.html");
    });

    $('#1_5').click(function(){
        $("#contenido").load("1.5v_reportes.html");
    });

    $('#2_1').click(function(){
        $("#contenido").load("2.1adms_estaciones.html");
    });

    $('#2_2').click(function(){
        $("#contenido").load("2.2adms_zonas.html");
    });

    $('#2_3').click(function(){
        $("#contenido").load("2.3adms_usuarios.html");
    });

    $('#2_4').click(function(){
        $("#contenido").load("2.4adms_permisos_sesiones.html");
    });

    $('#2_5').click(function(){
        $("#contenido").load("2.5adms_como_crear_usuario.html");
    });

    $('#2_6').click(function(){
        $("#contenido").load("2.6adms_como_agregar_permisos.html");
    });

    $('#2_7').click(function(){
        $("#contenido").load("2.7adms_como_crear_estacion.html");
    });

    $('#2_8').click(function(){
        $("#contenido").load("2.8adms_como_crear_zona.html");
    });

    $('#2_9').click(function(){
        $("#contenido").load("2.9adms_como_cerrar_sesiones");
    });
});