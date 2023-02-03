var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],
  [{'header': [1, 2, 3, 4, 5, 6, false]}],
  [{'font': []}],
  [{'size': ['small', false, 'large', 'huge']}],
  [{'color': []},{'background':[]}],
  [{'list': 'ordered'},{'list': 'bullet'}],
  [{'indent': '-1'}, {'indent': '+1'}],
  [{'align': []}],
  ['link', 'video'],
];
var quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions
  },
  theme: 'snow'
});

  var title = new Quill('#title-editor', {
    // placeholder: 'Digite el título de la sección',
    theme: 'bubble'
  });

  title.focus();

  function jsSave(){
      let titulo = title.container.firstChild.innerText;
    //   console.log(titulo);
      let contenido = quill.container.firstChild.innerHTML;
    //   console.log(contenido);
      fetch('insert.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      body: `titulo=${titulo}&contenido=${contenido}`
      });

      console.log('Insertado');
      var myVar = setInterval(myFunc, 1000);
      function myFunc() {
          $("#scroll-nav").load('fill-index.php');
          console.log(contenido);
      }        
    }

    function showTitle(str) {
      console.log(str);
      var title = "<h1 class='h1'>" + str + "</h1>";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById('title').innerHTML = title;
      }
      xhttp.open("POST", "quill-example.php");
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("p="+str);
    }

    function showCont(cont) {
    //   console.log(cont);
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById('content').innerHTML = cont;
      }
      xhttp.open("POST", "quill-example.php");
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("p="+cont);
    }

    function showTitleAndCont(title, cont) {
      showTitle(title);
      showCont(cont);
      console.log(cont);
    }
    
    function deleteCont() {
      let id = document.getElementById('hidden-id').innerText;
      console.log(id);

    fetch('delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
    body: `id=${id}`
    });
    }

    function editCont(id, tit, cont) {
        console.log(id);
        console.log(tit);
        console.log(cont);
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function () {
            document.getElementById('hidden-id').innerText = id;
            document.getElementById('title-editor').firstChild.innerHTML = "<p>"+ tit +"</p>";
            document.getElementById('editor').firstChild.innerHTML = cont;

        }
        xhttp.open("POST", "quill-example.php");
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("p="+cont);
    }
    function updateCont() {
        let id = document.getElementById('hidden-id').innerText;
        let titulo = title.container.firstChild.innerText;
        let contenido = quill.container.firstChild.innerHTML;
        console.log('Editado');

      fetch('update.php?id='+id+'&titulo=' + titulo + '&contenido=' + contenido);
      var myVar = setInterval(myFunc, 1000);
      function myFunc() {
          $("#scroll-nav").load('fill-index.php');
      } 
    }
    
    // Function to insert image into Quill editor
    function sendImage() {
      let img = document.getElementById('image').files[0];
      let imgName = img.name;
      console.log(imgName);

      const relativeUrl = "./img/"+imgName;
      console.log(relativeUrl);

      var imgTag = '<img src="' + relativeUrl + '">';
      quill.clipboard.dangerouslyPasteHTML(quill.getLength(), imgTag);
    }
