var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  [{ 'font': [] }],
  [{ 'size': ['small', false, 'large', 'huge'] }],
  [{ 'color': [] }, { 'background': [] }],
  [{ 'list': 'ordered' }, { 'list': 'bullet' }],
  [{ 'indent': '-1' }, { 'indent': '+1' }],
  [{ 'align': [] }],
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

function jsSave() {
  let titulo = title.container.firstChild.innerText;
  let contenido = quill.container.firstChild.innerHTML;
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  
  
  if (selectedHierarchy === '1') {
    fetch('insert.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
    });
    console.log('Insertado');
    
  }

  if (selectedHierarchy == "2" || selectedHierarchy == "3") {
    let parent = document.getElementById("parent");
    let selectedParent = parent.options[parent.selectedIndex].value;
    if (selectedHierarchy === '2') {
      fetch('insert.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}&parent=${selectedParent}`
      });
      console.log('Insertado');
    } else if (selectedHierarchy === '3') {
      fetch('insert.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}&parent=${selectedParent}`
      });
      console.log('Insertado');
    }
  } 

  var myVar = setInterval(myFunc, 1000);
  function myFunc() {
    $("#scroll-nav").load('fill-index.php');
  }
}
function showTitle(str) {
  console.log(str);
  var title = "<h1 class='h1'>" + str + "</h1>";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('title').innerHTML = title;
  }
  xhttp.open("POST", "quill-example.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p=" + str);
}
function showCont(cont) {
  //   console.log(cont);
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('content').innerHTML = cont;
  }
  xhttp.open("POST", "quill-example.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p=" + cont);
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
    document.getElementById('title-editor').firstChild.innerHTML = "<p>" + tit + "</p>";
    document.getElementById('editor').firstChild.innerHTML = cont;

  }
  xhttp.open("POST", "quill-example.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p=" + cont);
}
function updateCont() {
  let id = document.getElementById('hidden-id').innerText;
  let titulo = title.container.firstChild.innerText;
  let contenido = quill.container.firstChild.innerHTML;
  console.log('Editado');

  fetch('update.php?id=' + id + '&titulo=' + titulo + '&contenido=' + contenido);
  var myVar = setInterval(myFunc, 1000);
  function myFunc() {
    $("#scroll-nav").load('fill-index.php');
  }
}
function sendImage() {
  let img = document.getElementById('image').files[0];
  let imgName = img.name;
  console.log(imgName);

  const relativeUrl = "./img/" + imgName;
  console.log(relativeUrl);

  var imgTag = '<img src="' + relativeUrl + '">';
  quill.clipboard.dangerouslyPasteHTML(quill.getLength(), imgTag);
}

document.getElementById("select-hierarchy").addEventListener("change", showOrHideDiv);

function showOrHideDiv() {
  let select = document.getElementById("select-hierarchy");
  let div = document.getElementById("h");
  let selectedOption = select.options[select.selectedIndex].value;

  if (selectedOption === "0" || selectedOption === "1") {
    div.classList.add("d-none");
  } else {
    div.classList.remove("d-none");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "fill-select.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        let resultSelect = document.getElementById("parent");
        resultSelect.innerHTML = this.responseText;
      }
    };
    xhr.send("hierarchy=" + selectedOption);

  }
}