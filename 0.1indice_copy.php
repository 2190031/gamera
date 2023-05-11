<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2a3b3d5bf4.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/gamera_logo-vector.png" type="image/x-icon">
  <title>Gamera</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

  <script>
    $(document).ready(function() {
      $('#1').click(function() {
        $("#contenido").load("funcionamiento_general.html");
      });

      $('#1_2').click(function() {
        $("#contenido").load("ventana_de_listado_tipo_simple.html");
      });

      $('#1_3').click(function() {
        $("#contenido").load("ventana_de_listado_con_filtro_de_datos.html");
      });

      $('#1_4').click(function() {
        $("#contenido").load("elementos_comunes_de_las_ventanas.html");
      });

      $('#1_5').click(function() {
        $("#contenido").load("ventana_de_reportes.html");
      });

      $('#2_1').click(function() {
        $("#contenido").load("estaciones.html");
      });

      $('#2_2').click(function() {
        $("#contenido").load("zonas.html");
      });

      $('#2_3').click(function() {
        $("#contenido").load("usuarios.html");
      });

      $('#2_4').click(function() {
        $("#contenido").load("permisos.html");
      });

      $('#2_5').click(function() {
        $("#contenido").load("2.5adms_como_crear_usuario.html");
      });

      $('#2_6').click(function() {
        $("#contenido").load("2.6adms_como_agregar_permisos.html");
      });

      $('#2_7').click(function() {
        $("#contenido").load("2.7adms_como_crear_estacion.html");
      });

      $('#2_8').click(function() {
        $("#contenido").load("2.8adms_como_crear_zona.html");
      });
      $('#2_9').click(function() {
        $("#contenido").load("2.9adms_como_cerrar_sesiones");
      });
    });
  </script>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Gamera</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <form method="get" action="buscador.php" class="d-flex" role="search">
          <input class="form-control me-2" id="search" type="text" name="q" id="buscador" placeholder="Búsqueda" aria-label="Search" style="width: 400px;" autocomplete="off">
        </form>
      </div>
      <ul id="results"></ul>
    </nav>
  </header>
  <div class="general">

    <div class="contenido" id="conten">

      <section class="box" id="contenido">

        <h2>SISTEMA</h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sapiente natus, corrupti dolore dolorem
          doloremque. Accusantium, placeat velit! Sit accusamus ipsa rem a vel exercitationem tempora sequi voluptatem
          nobis adipisci! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, omnis sunt eius commodi
          quae repellat reprehenderit amet, recusandae ab eos odit in, eveniet nam veniam obcaecati doloribus ad
          dignissimos soluta?</p> <br>

        <h2>AYUDA</h2>

        <p>Esta es la seccion de ayuda, aqui podra ver el funcionamiento de cada elemento del sistema. Tiene un indice a
          su izquierda que lo llevara a la ayuda que necesite, de igual forma, habra un buscador en la parte superior
          derecha para buscar cosas mas especificas.</p>
        <br>
        <img src="img/GameraIndice.png" width="600" alt="" class="box-img">

      </section>

    </div>


    <?php include("indice_elementos.html"); ?>

    <!-- Copyright -->
    </footer>
    <script>
          var toggler = document.getElementsByClassName("caret");
          var i;
          
          for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
              this.parentElement.querySelector(".nested").classList.toggle("active");
              this.classList.toggle("caret-down");
            });
          }
          </script>
    <script src="js/buscar_.js"></script>
    <script src="js/indice-js.js"></script>

</html>