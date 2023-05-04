<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones demo</title>

  <link href="css/style.css" rel="stylesheet">

  <!-- Sweet alert -->
  <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="sweetalert/sweetalert2.all.min.js"></script>

  <!-- Main Quill library -->
  <!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script> -->
  <script src="quill/quill.js"></script>
  <script src="quill/quill.min.js"></script>

  <!-- Theme included stylesheets -->
  <!-- <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet"> -->
  <link href="quill\quill.snow.css" rel="stylesheet">
  <link href="quill\quill.bubble.css" rel="stylesheet">

  <!-- Core build with no theme, formatting, non-essential modules -->
  <!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
  <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->
  <link href="quill\quill.core.css" rel="stylesheet">
  <script src="quill\quill.core.js"></script>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
  <script src="bootstrap\js\bootstrap.js"></script>
  <!-- 
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
  <script type="text/javascript" src="js/media_query.js"></script>

</head>

<body onload="cargarIndice()" class="">
  <div class="container">
    <h1 class="h1">Inserte una nueva sección</h1>
    <h2 class="h2">Título</h2>

    <div id="" class="mb-3">
      <input type="text" name="title" id="input-title" class="form-control">
    </div>
    <h2 class="h2">Tipo de artículo</h2>
    <select class="form-select" id="select-hierarchy">
      <option value="1" selected>Principal</option>
      <option value="2">Secundario</option>
      <option value="3">Terciario</option>
      <option value="4">Cuaternario</option>
    </select>
    <br>

    <div id="h" class="d-none">
      <h2 class="h2">Sección a la que pertenece</h2>
      <input class="form-control" list="parent" id="parents" placeholder="Type to search...">
      <datalist id="parent">
        <?php include('fill-datalist.php'); ?>
      </datalist>
      <br><br>
    </div>

    <div id="editor" class="container-sm" data-placeholder="Digite el título de la sección">

    </div>

    <br>
    <div class="row row-cols-lg-auto g-3 align-items-center">
      <div class="col">
        <button id="guardar" class="btn btn-outline-primary" title='Guardar archivo' onclick=jsSave() onload="enableButton()">Guardar archivo</button>
      </div>
      <div class="col">
        <button id="borrar" class="btn btn-outline-danger" title='Eliminar archivo' onclick=deleteCont()>Eliminar archivo</button>
      </div>
      <div class="col">
        <button id="editar" class="btn btn-outline-warning" title='Sobreescribir cambios. (Debe seleccionar el artículo deseado en el índice)' onclick=updateCont()>Sobreescribir</button>
      </div>
      <div class="col">
        <button id="btn-limpiar" class="btn btn-outline-info" title='Limpiar los campos' onclick=limpiarCampos()>Limpiar campos</button>
      </div>
      <div class="ms-auto">
        <div class="input-group">
          <button class="btn btn-outline-success" type="button" title='Insertar imagen en el artículo' onclick=sendImage()>Insertar imagen</button>
          <input class="form-control" title='Buscar imagen (debe estar en la carpeta de imágenes)' type="file" id="image">
          <button class="btn btn-outline-secondary" type="button" title='Subir imagen en el artículo' onclick=uploadImage()>Subir imagen</button>
        </div>
      </div>
    </div>
    <p name="id" id="hidden-id" value="$row['id']" hidden></p>
    <hr>
    <br>
    <div id="scroll-nav card">
      <div id="snav">
        <?php
        include_once('fill-index.php');
        ?>
      </div>
    </div>



  </div>

  <hr>

  <h1 class="h1">Índice - Vista previa</h1>
  <div class="row">
    <div class="col-5">
      <div class="h-100 flex-column align-items-stretch pe-4 border-end">
        <div class='indice'>
          <div id="indice-importado">

          </div>
          <!-- <h1 class="h1">Agregar al índice</h1><div id="contenido"></div> -->
        </div>
      </div>
    </div>


    <div class="col-5">
      <div data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
        <p>Resultado</p>
        <div id="parent">
          <small class="fw-light">Este articulo pertenece a: <p id="show-parent"></p></small>
        </div>
        <div id="output">
          <div id="title"></div>

          <div id="contenido"></div>
        </div>
      </div>
    </div>
  </div>


  <div class="d-none" id="indice-js">

  </div>
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
  <script src="js/indice-js.js"></script>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="quill/quill.js"></script>
  <script src="js/editor-js.js"></script>
</body>

</html>