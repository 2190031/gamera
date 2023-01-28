var quill = new Quill('#editor', {
    placeholder: 'lorem ipsum dolor sit amet',
    theme: 'snow'
  });
  var title = new Quill('#title-editor', {
    placeholder: 'Digite el título de la sección',
    theme: 'bubble'
  });

  function jsSave(){
      let titulo = title.container.firstChild.innerText;
      console.log(titulo);

      let contenido = quill.container.firstChild.innerHTML;
      console.log(contenido);

      fetch('insert.php?titulo=' + titulo + '&contenido=' + contenido);

      // document.getElementById('output').innerHTML = "<h1 class='h1'>" + titulo + "</h1>" + "<br>" + contenido;
      
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