<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <div id="editor">
        <p>Hello World!</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br></p>
    </div>
  
    <br>
    <button class="btn btn-primary" onclick=jsSave()>Guardar</button>
    <div id="output">
      <p>Resultado</p>
    </div>
  </div>


      <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      
      <!-- Initialize Quill editor -->
      <script>
        var quill = new Quill('#editor', {
          theme: 'snow'
        });

        function jsSave(){
            let contenido = quill.container.firstChild.innerHTML;
            fetch('insert.php?contenido=' + contenido);
            alert('Guardado correctamente');
            console.log(contenido);

            const output = document.createElement('div');
            // output.innerHTML = country.name + " " + country.alpha2Code;
            document.getElementById('output').innerHTML = contenido;
        }

        
      </script>

    
</body>
</html>