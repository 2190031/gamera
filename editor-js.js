var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],
  [{'header': [1, 2, 3, 4, 5, 6, false]}],
  [{'font': []}],
  [{'size': ['small', false, 'large', 'huge']}],
  [{'color': []},{'background':[]}],
  [{'list': 'ordered'},{'list': 'bullet'}],
  [{'indent': '-1'}, {'indent': '+1'}],
  [{'align': []}],
  ['link', 'image', 'video']
];


var quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions
  },
  theme: 'snow'
});

var range = quill.getSelection();
if (range) {
  var imageUrl = 'https://img2.rtve.es/i/?w=1600&i=1634194794500.jpg';
  quill.insertEmbed(range.index, 'image', imageUrl, Quill.sources.USER);
  quill.setSelection(range.index + 1, Quill.sources.SILENT);
}

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
    //   console.log(cont);
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
        xhttp.open("GET", "quill-example.php?r=" + cont);
        xhttp.send();
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