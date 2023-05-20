<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/gamera/css/estilo.css">
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
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Gamera</a>
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

    <div class="contenido text-break" id="conten">

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

    <!-- Footer -->
  <footer class="footer" >
  
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

    <div class="me-5 d-none d-lg-block">
      <span>Conéctate con nosotros en las redes sociales:</span>
    </div>

    <div>
      <a href="https://www.facebook.com/gamerasoft/" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.instagram.com/gamerasoftware/" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
    </div>
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Gamera Software
          </h6>
          <p>
            Empresa de Desarrollo de Software tanto para Windows como para Android.
          </p>
        </div>
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contáctanos</h6>
          <p><i class="fas fa-home me-3"></i> C. Proy. 3 Esq Proy. 1 #5 , Santiago de Los Caballeros</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            mayobanex@gamerasoft.com
          </p>
          <p><i class="fas fa-phone me-3"></i>809 276 2410</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="http://gamera.ddns.net/">Gamera Software</a>
  </div>

  <!-- Copyright -->
</footer>

</html>