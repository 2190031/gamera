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
  theme: 'bubble'
});

title.focus();

function jsSave() {
  let titulo = title.container.firstChild.innerText;
  let contenido = quill.container.firstChild.innerHTML;
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  let selectedParent = "";
  if (selectedHierarchy > 1) {
    let parent = document.getElementById('parent');
    selectedParent = parent.options[parent.selectedIndex].value;
  }
  

  let regex = /^[a-zA-Z0-9_,.;:!¿?ÁÉÍÓÚáéíóúñÑ\s]+$/;
  if (!regex.test(titulo)) {
    swal(
      'Caracteres especiales no permitidos',
      'Favor de utilizar solo letras, números y algunos caracteres especiales permitidos como , . ; : ! ¿ ?',
      'warning'
    );
    return;
  }

  if (titulo == null || contenido == null || selectedHierarchy == 0) {
    swal(
      'Se han encontrado uno o más campos vacíos',
      'Favor de llenar todos los campos',
      'warning', {
        timer: 5000,
      });
    } else {
      if (selectedParent == "") {
        fetch('insert.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
        }).then(response => {
          if (response.ok) {
            console.log('Insertado');
            swal(
              'Insertado correctamente',
              'Puede cerrar esta ventana',
              'success', {
                timer: 5000,
              });
            myFunc();
          }
        });
      } else if (selectedParent != "") {
        fetch('insert.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}&parent=${selectedParent}`
        }).then(response => {
          if (response.ok) {
            console.log('Insertado');
            swal(
              'Insertado correctamente',
              'Puede cerrar esta ventana',
              'success', {
                timer: 5000,
              });
            myFunc();
          }
        });
      }
     
      // console.log('Insertado');
      // swal(
      //   'Insertado correctamente',
      //   'Puede cerrar esta ventana',
      //   'success', {
      //     timer: 5000,
      //   });
      
      // var myVar = setInterval(myFunc, 1000);
      function myFunc() {
        $("#scroll-nav").load('fill-index.php');
      }
  } 
/* apendice de codigo
console.log(str);
var title = "<h1 class='h1'>" + str + "</h1>";
const xhttp = new XMLHttpRequest();
xhttp.onload = function () {
  document.getElementById('title').innerHTML = title;
}
xhttp.open("POST", "editor.php");
xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhttp.send("p=" + str);
*/
}
function showCont(cont) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('content').innerHTML = cont;
  }
  xhttp.open("POST", "editor.php");
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
  let titulo = title.container.firstChild.innerText;
  console.log(titulo);
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;

  if (id == null || titulo == null || selectedHierarchy == 0) {
    swal(
      'Se han encontrado uno o más campos vacíos',
      'Debe seleccionar uno de los registros',
      'warning', {
        timer: 5000,
      });
  } else {
    fetch('delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id=${id}&titulo=${titulo}&hierarchy=${selectedHierarchy}`
    });
    swal(
      'Eliminado exitosamente',
      'Puede cerrar esta ventana',
      'success', {
        timer: 5000,
      });
  }
}
function editCont(id, tit, hie, cont) {
  console.log(id);
  console.log(tit);
  console.log(cont);
  console.log(hie);
  
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  console.log(selectedHierarchy);
  
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('hidden-id').innerText = id;
    document.getElementById('title-editor').firstChild.innerHTML = "<p>" + tit + "</p>";
    document.getElementById('editor').firstChild.innerHTML = cont;
    hierarchy.options[hie].selected = true
  }
  xhttp.open("POST", "editor.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p=" + cont);

}
function updateCont() {
  let id = document.getElementById('hidden-id').innerText;
  let titulo = title.container.firstChild.innerText;
  let contenido = quill.container.firstChild.innerHTML;
  
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  
  if (id == "") {
    swal(
      'No se ha seleccionado un registro',
      'Favor de seleccionar uno',
      'warning', {
        timer: 5000,
      });
  } else {
    fetch('update.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id=${id}&titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
    });
    console.log('Editado');
    swal(
      'Modificado existosamente',
      'Puede cerrar esta ventana',
      'success', {
        timer: 5000,
      });
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
function printFile() {
  
}