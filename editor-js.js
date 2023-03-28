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


/*
  Toma el titulo, jerarquia, tabla padre (si aplica) y contenido para insertarlo en la
  base de datos. Verifica que no haya caracteres especiales en el titulo y ejecuta una
  funcion para refrescar el indica una sola vez cuando se ejecuta la funcion
*/
function jsSave() {
  let titulo = document.getElementById("input-title").value;
  let contenido = quill.container.firstChild.innerHTML.trim();
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  let selectedParent = "";
  let parentTitle = "";
  if (selectedHierarchy > 1) {
    let parent = document.getElementById('parent');
    selectedParent = parent.options[parent.selectedIndex].value;
    parentTitle = parent.options[parent.selectedIndex].text;
  }


  let regex = /^[a-zA-Z0-9_,.;:!¿?ÁÉÍÓÚáéíóúñÑ\s]+$/;
  if (titulo == "") {
    Swal.fire(
      'Se han encontrado uno o más campos vacíos',
      'Favor de llenar todos los campos',
      'warning', {
      timer: 5000,
    });
    return;
  } else if (!regex.test(titulo)) {
    Swal.fire(
      'Caracteres especiales no permitidos',
      'Favor de utilizar solo letras, números y algunos caracteres especiales permitidos como , . ; : ! ¿ ?',
      'warning'
    );
    return;
  }

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
        Swal.fire(
          'Insertado correctamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
        primaryToIndex(titulo, 'primary');
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
        Swal.fire(
          'Insertado correctamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
        if (selectedHierarchy == 2) {
          addToIndex(parentTitle, 'secondary', titulo);
        } else if (selectedHierarchy == 3) {
          addToIndex(parentTitle, 'terciary', titulo);
        } else if (selectedHierarchy == 4) {
          addToIndex(parentTitle, 'cuaternary', titulo);
        }
      }
    });
  }
}

/*
  Funciones para obtener el titulo y contenido como parametros despues de las primeras 2
  funciones, llamandolas simultaneamente en la tercera
*/
function showTitle(str) {
  var title = "<h1 class='h1'>" + str + "</h1>";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('title').innerHTML = title;
  }
  xhttp.open("POST", "editor.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("p=" + str);
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
  // console.log(cont);
}

/*
  (Solo despues de hacer click en su boton para editar) Utiliza el ID oculto del registro
  para eliminar el archivo y registro
 */
function deleteCont() {
  let id = document.getElementById('hidden-id').innerText;
  let titulo = document.getElementById("input-title").value;
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;

  if (id == null || titulo == "" || selectedHierarchy == 0) {
    Swal.fire(
      'Se han encontrado uno o más campos vacíos',
      'Debe seleccionar uno de los registros',
      'warning', {
      timer: 5000,
    });
  } else {
    Swal.fire({
      title: '¿Está seguro de que desea eliminar este registro?',
      text: "No podrá deshacer esta acción.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('delete.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id=${id}&titulo=${titulo}&hierarchy=${selectedHierarchy}`
        });
        Swal.fire(
          'Eliminado exitosamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
      }
    })
  }
}

/*
  Toma los valores del registro (despues de presionar el boton de editar) y los coloca en
  el editor y en un campo oculto el ID para prepararlo para su edicion
*/
function editCont(id, tit, hie, cont) {

  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value; 

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('hidden-id').innerText = id;
    document.getElementById("input-title").value = tit;
    document.getElementById('editor').firstChild.innerHTML = cont;
    hierarchy.options[hie - 1].selected = true
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
  let titulo = document.getElementById("input-title").value;
  let contenido = quill.container.firstChild.innerHTML;

  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;

  if (id == "") {
    Swal.fire(
      'No se ha seleccionado un registro',
      'Favor de seleccionar uno',
      'warning', {
      timer: 5000,
    });
  } else {
    Swal.fire({
      title: '¿Estás seguro de querer editar?',
      text: 'No podrás deshacer esta acción',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, editar',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('update.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id=${id}&titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
        });
        console.log('Editado');
        Swal.fire(
          'Modificado existosamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
      }
    })
  }
}

/* 
  Procesa la imagen, toma el nombre del archivo y su extension, verifica si esta o no
  en la carpeta de imagenes y la inserta en el editor
*/
function sendImage() {
  let img = document.getElementById('image').files[0];
  let imgName = img.name;

  const relativeUrl = "img/" + imgName;
  console.log(relativeUrl);

  var imgTag = '<img src="' + relativeUrl + '">';
  quill.clipboard.dangerouslyPasteHTML(quill.getLength(), imgTag);
}

function uploadImage() {
  let img = document.getElementById('image').files[0];

  if (img == null || img == "" || !img) {
    Swal.fire(
      'No se ha seleccionado ninguna imagen',
      'Favor de seleccionar',
      'warning', {
      timer: 5000,
    });
  } else {
    let formData = new FormData();
    let imgName = img.name;
    formData.append('image', img);
    formData.append('imageName', imgName);

    // Envía el formulario mediante AJAX
    fetch('upload_image.php', {
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.ok) {
        Swal.fire(
          'Imagen subida existosamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
        return response.json();
      } else {

        throw new Error('Error al subir la imagen');
      }
    }).then(data => {
      console.log(data.message);
    }).catch(error => {
      console.error(error.message);
    });
  }

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
      } else if (xhr.status === 404) {
        Swal.fire(
          'Error',
          'Es posible que el archivo haya sido eliminado, cambiado el nombre o de lugar',
          'error', {
          timer: 5000,
        });
        return;
      }
    };
    xhr.send("hierarchy=" + selectedOption);

  }
}

/* 
  Imprime el contenido de un archivo en base a su ruta y nombre de archivo y lo coloca
  en una seccion de la pagina 
*/
document.getElementById("print-btn").addEventListener("click", function () {
  printFile(title, folder);
});

function printFile(filename, folder, title, parent) {
  let file = folder + filename + ".html";
  console.log("archivo " + file);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", file, true);
  if (!parent && !title) {
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("show-parent").innerHTML = "";
        document.getElementById("title").innerHTML = "<h1>" + filename + "</h1>";
        document.getElementById("content").innerHTML = xhr.response;
      } else if (xhr.status === 404) {
        Swal.fire(
          'Archivo no encontrado',
          'Es posible que el archivo haya sido eliminado, cambiado el nombre o de lugar',
          'error', {
          timer: 5000,
        });
        return;
      }
    };
  } else if (parent && title) {
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("show-parent").innerText = parent;
        document.getElementById("title").innerHTML = "<h1>" + title + "</h1>";
        document.getElementById("content").innerHTML = xhr.response;
      } else if (xhr.status === 404) {
        Swal.fire(
          'Archivo no encontrado',
          'Es posible que el archivo haya sido eliminado, cambiado el nombre o de lugar',
          'error', {
          timer: 5000,
        });
        return;
      }
    };
  }
  xhr.send();
}

function refreshIndex() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#snav").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "fill-index.php", true);
  xhttp.send();
}

function clearFields() {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esto borrará todos los campos.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, borrar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      clear();
    }
  });
}

document.getElementById('limpiar').addEventListener('click', clearFields);

function clear() {
  document.getElementById('input-title').value = '';
  quill.setText('');
  document.getElementById('image').value = '';
}

function cargarIndice() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("indice-importado").innerHTML = this.responseText;
    }
  }
  xhr.open("GET", "0.1indice_copy.html");
  xhr.send();
}

function primaryToIndex(title, category) {
  const index = document.querySelector('.indice');
  const treeview = index.querySelectorAll('.treeview');
  const parentIndex = document.getElementsByClassName('box-indice');
  if (category == 'primary') {
    const ul = document.createElement('ul');

    const li = document.createElement('li');
    const span = document.createElement('span');
    const template = document.createElement('ul');

    ul.id = title;
    ul.className = 'treeview';

    template.className = 'nested';
    template.dataset.parent = title;
    template.dataset.category = 'secondary';

    span.className = 'carret primary';

    ul.dataset.category = 'primary';

    const a = document.createElement('a');
    a.href = '#';
    a.textContent = title;

    span.appendChild(a);
    li.appendChild(span);
    li.appendChild(template);
    ul.appendChild(li);
    document.getElementsByClassName('box-indice')[0].appendChild(ul);
  }
  createIndex();
}
function addToIndex(parentId, category, title) {
  const parentElement = document.querySelector(`[data-category="${category}"][data-parent="${parentId}"]`);
  const template = document.createElement('ul');
  if (parentElement) {
    const newElement = document.createElement("li");
    const a = document.createElement('a');
    a.href = '#';
    a.textContent = title;

    newElement.appendChild(a);
    if (category == 'secondary') {
      template.className = 'nested';
      template.dataset.parent = title;
      template.dataset.category = 'terciary';

      newElement.appendChild(template);
      parentElement.appendChild(newElement);
    } else if (category == 'terciary') {
      template.className = 'nested';
      template.dataset.parent = title;
      template.dataset.category = 'quaternary';

      newElement.appendChild(template)
      parentElement.appendChild(newElement);
    } else if (category == 'quaternary') {
      parentElement.appendChild(newElement)
    }
  }
  createIndex();
}

function createIndex() {
  let cont = document.getElementById('indice-importado').innerHTML;
  console.log(cont);
  fetch(
    'edit_nav.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `cont=${cont}`
    }
  ).then(response => {
    if (response.ok) {
      console.log('creado');
      Swal.fire(
        'Insertado correctamente',
        'Puede cerrar esta ventana',
        'success', {
        timer: 5000,
      });
    } else {
      console.log('error');
    }
  });
}