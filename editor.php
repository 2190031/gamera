<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones demo</title>

  <link href="style.css" rel="stylesheet">

  <!-- Sweet alert -->
  <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="sweetalert/sweetalert2.all.min.js"></script>

  <!-- Main Quill library -->
  <!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script> -->
  <script src="quill\quill.js"></script>
  <script src="quill\quill.min.js"></script>

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

  <script>
    function getLiElements() {
      const content = document.getElementById('indice').innerHTML;
      const lines = content.split('\n');
      const liElements = lines.filter(line => line.includes('<li><a href="#" id'));
      document.getElementById('indice').innerHTML = liElements.toString();
      console.log(liElements);
      liElements.splice(0, 0, '<li><a href="#" class>Nuevo Link</a></li>');
      console.log(liElements)
      document.getElementById('indice2').innerHTML = liElements.toString();
    }
  </script>
</head>

<body onload="cargarIndice()">
  <div class="container">
    <h1 class="h1">Inserte una nueva sección</h1>
    <h2 class="h2">Título</h2>

    <div id="" class="mb-3">
      <input type="text" name="title" id="input-title" class="form-control">
    </div>
    <h2 class="h2">Tipo de articulo</h2>
    <select class="form-select" id="select-hierarchy">
      <option value="1" selected>Principal</option>
      <option value="2">Secundario</option>
      <option value="3">Terciario</option>
      <option value="4">Cuaternario</option>
    </select>
    <br>

    <div id="h" class="d-none">
      <h2 class="h2">Seccion a la que pertenece</h2>
      <select class="form-select" id="parent">
        <?php include('fill-select.php'); ?>
      </select>
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
        <button id="editar" class="btn btn-outline-warning" title='Sobreescribir cambios. (Debe seleccionar el artículo deseado en el índice)' onclick=updateCont()>Guardar cambios</button>
      </div>
      <div class="col">
        <button id="limpiar" class="btn btn-outline-info" title='Limpiar los campos' onclick=clear()>Limpiar campos</button>
      </div>
      <div class="ms-auto">
        <div class="input-group">
          <button class="btn btn-outline-success" type="button" title='Insertar imagen en el artículo' onclick=sendImage()>Insertar imagen</button>
          <input class="form-control" title='Buscar imagen (debe estar en la carpeta de imágenes)' type="file" id="image">
          <button class="btn btn-outline-secondary" type="button" title='Subir imagen en el artículo' onclick=uploadImage()>Subir imagen</button>
        </div>
      </div>
    </div>
    <br>
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
  <button class="btn btn-outline-primary" onclick="primaryToIndex('nuevo','primary')">Cargar</button>
  <button class="btn btn-outline-primary" onclick="addToIndex('grupo1','secondary','secondary')">Cargar</button>
  <button class="btn btn-outline-primary" onclick="addToIndex('grupo1','terciary','terciary')">Cargar</button>
  <button class="btn btn-outline-primary" onclick="addToIndex('grupo1','quaternary','quaternary')">Cargar</button>

  <button class="btn btn-outline-primary" onclick="cargarIndice()">Cargar</button>

  <hr>

  <h1 class="h1">Agregar al índice</h1>
  <div class='indice'>
    <div id="indice-importado">

    </div>
  </div>


  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Initialize Quill editor -->
  <script src="editor-js.js"></script>

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
  </script>
</body>

</html>