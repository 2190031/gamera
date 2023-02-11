/* 
  Vairable que inicializa el editor para el titulo en el div title-editor
*/
var title = new Quill('#title-editor', {
  theme: 'bubble'
});

/*
  Modulos (opciones de la barra de herramientas) del editor para el cuerpo del articulo
*/
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

/*
  Variable que inicializa el editor para el cuerpo del articulo en el div editor
*/
var quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions
  },
  theme: 'snow'
});

/*
  Da enfoque automaticamente al editor de titulo
*/
title.focus();

/*
  Toma el titulo, jerarquia, tabla padre (si aplica) y contenido para insertarlo en la
  base de datos. Verifica que no haya caracteres especiales en el titulo y ejecuta una
  funcion para refrescar el indica una sola vez cuando se ejecuta la funcion
*/
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

/*
  Funciones para obtener el titulo y contenido como parametros despues de las primeras 2
  funciones, llamandolas simultaneamente en la tercera
*/
function showTitle(str) {
  var title = "<h1 class='h1'>" + str + "</h1>";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById('title').innerHTML = title;
  }
  xhttp.open("POST", "editor.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p="+str);
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

/*
  (Solo despues de hacer click en su boton para editar) Utiliza el ID oculto del registro
  para eliminar el archivo y registro
 */
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

/*
  Toma los valores del registro (despues de presionar el boton de editar) y los coloca en
  el editor y en un campo oculto el ID para prepararlo para su edicion
*/
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

/*
  Verifica si se ha seleccionado un registro del indice (a traves del boton para editar)
  y ejecuta la consulta para hacer update al registro segun su ID
*/
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

/* 
  Procesa la imagen, toma el nombre del archivo y su extension, verifica si esta o no
  en la carpeta de imagenes y la inserta en el editor
*/
function sendImage() {
  let img = document.getElementById('image').files[0];
  let imgName = img.name;
  console.log(imgName);

  const relativeUrl = "./img/" + imgName;
  console.log(relativeUrl);

  var imgTag = '<img src="' + relativeUrl + '">';
  quill.clipboard.dangerouslyPasteHTML(quill.getLength(), imgTag);
}

/* 
Quita la clase d-none que oculta un select en la pagina mientras el tipo de articulo 
sea la opcion por defecto o principal, al cambiaro se muestra el select
*/
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

/* 
  Imprime el contenido de un archivo en base a su ruta y nombre de archivo y lo coloca
  en una seccion de la pagina 
*/
// function printFile(title, folder) {
//   let file = folder + title + '.html';
//   console.log(file);
//   document.getElementById("print-btn").addEventListener("click", function() {
//     var xhr = new XMLHttpRequest();
//     xhr.open("GET", file, true);
//     xhr.onreadystatechange = function() {
//       if (xhr.readyState === 4 && xhr.status === 200) {
//         document.getElementById("title").innerHTML = "<h1>" + title + "</h1>";
//         document.getElementById("content").innerHTML = xhr.response;
//       }
//     };
//     xhr.send();
//   });
// }
document.getElementById("print-btn").addEventListener("click", function() {
  printFile(title, folder);
});

function printFile(title, folder) {
  let file = folder + title + '.html';
  console.log(file);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", file, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("title").innerHTML = "<h1>" + title + "</h1>";
      document.getElementById("content").innerHTML = xhr.response;
    }
  };
  xhr.send();
}