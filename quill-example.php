<?php
$conn = new mysqli("localhost", "root", "c55h32o5n4Mg", "document");

if ($conn->connect_error) {
    die("Error: ".$conn->connect_errno ." " .$conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
      <div id="title-editor">
        <p class="h2">lorem ipsum</p>
      </div>

    </div>
    <div id="editor" class="container-sm">
        <p>Hello World!</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br></p>
    </div>
  
    <br>
    <button class="btn btn-primary" onclick=jsSave()>Guardar</button>
    <br>
    <hr>

    <div id="scroll-nav">
      <?php
        include_once('fill-index.php')
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
      <script>
        var quill = new Quill('#editor', {
          theme: 'snow'
        });
        var title = new Quill('#title-editor', {
          theme: 'bubble'
        });

        function jsSave(){
            let titulo = title.container.firstChild.innerText;

            console.log(titulo);

            let contenido = quill.container.firstChild.innerHTML;
            console.log(contenido);

            fetch('insert.php?titulo=' + titulo + '&contenido=' + contenido);

            document.getElementById('output').innerHTML = "<h1 class='h1'>" + titulo + "</h1>" + "<br>" + contenido;
            
            var myVar = setInterval(myFunc, 1000);

            function myFunc() {
                $("#scroll-nav").load('fill-index.php');
            }        
          }


          function showTitle(str) {
            console.log(str);
            var title = "<h1 class='h1'>" + str + "</h1>";
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
              document.getElementById('title').innerHTML = title;
            }
            xhttp.open("GET", "quill-example.php?p="+str);
            xhttp.send();
          }

          function showCont(cont) {
            console.log(cont);
            
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
              document.getElementById('content').innerHTML = cont;
            }
            xhttp.open("GET", "quill-example.php?p="+cont);
            xhttp.send();
          }

          function showTitleAndCont(title, cont) {
            showTitle(title);
            showCont(cont);
          }
        
      </script>

    
</body>
</html>