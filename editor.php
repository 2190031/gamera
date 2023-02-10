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

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="h1">Inserte una nueva sección</h1>
    <h2 class="h2">Título</h2>

    <div id="input-title" class="mb-3">
      <div id="title-editor" class="ql-container ql-bubble"> 

      </div>
    </div>
    <h2 class="h2">Tipo de articulo</h2>
    <select class="form-select" id="select-hierarchy">
      <option selected value="0">Tipo de seccion...</option>
      <option value="1">Principal</option>
      <option value="2">Secundario</option>
      <option value="3">Terciario</option>
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
        <p><br></p>
    </div>
  
    <br>
    <div class="row row-cols-lg-auto g-3 align-items-center">
      <div class="col">
        <button class="btn btn-primary" onclick=jsSave()>Guardar</button>
      </div>
      <div class="col">
        <button class="btn btn-warning" onclick=updateCont()>Editar</button>
      </div>
      <div class="col">
        <button class="btn btn-danger"  onclick=deleteCont()>Delete</button>
      </div>
      <div class="col">
        <div class="input-group mb-3">
          <button class="btn btn-secondary" onclick=sendImage()>Insertar</button>
          <input class="form-control" type="file" id="image">
        </div>
      </div>
    </div>
    <br>
<p name="id" id="hidden-id" value="$row['id']" hidden></p>
    <hr>

    <div id="scroll-nav">
      <?php
        include_once('fill-index.php');
      ?>
    </div>

<br><hr><br>
    <div id="output">
      <p>Resultado</p>
      <div id="title"></div>
      
      <div id="content"></div>
    </div>
  </div>
      <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- Initialize Quill editor -->
      <script src="editor-js.js"></script>
</script>
</body>
</html>