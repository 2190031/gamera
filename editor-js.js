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
    console.log(selectedParent, " ", parentTitle);
  }


  let regex = /[a-zA-Z0-9_,.;ÁÉÍÓÚáéíóúñÑ]/;
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
      'Favor de utilizar solo letras, números y algunos caracteres especiales permitidos como , . ;',
      'warning'
    );
    return;
  }
  const _titulo = titulo.split(" ").join("_");
  console.log(_titulo);
  if (selectedParent == "") {
    fetch('insert.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `titulo=${titulo}&_titulo=${_titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
    }).then(response => {
      if (response.ok) {
        console.log('Insertado');
        Swal.fire(
          'Insertado correctamente',
          'Puede cerrar esta ventana',
          'success', {
          timer: 5000,
        });
        response.json().then(data => {
          const indexID = data.indexID;
          console.log(indexID);
          console.log('Insertado');
          Swal.fire(
            'Agregado correctamente al índice',
            'Puede cerrar esta ventana',
            'success', {
            timer: 5000,
          });

          primaryToIndex(titulo, _titulo, 'primary', indexID);
        }).catch(error => {
          console.log('Insertado');
          Swal.fire(
            'Ha ocurrido un error',
            'Puede cerrar esta ventana',
            'error', {
            timer: 5000,
          });
          console.error(error);
        });
        }
    });
  } else if (selectedParent != "") {
    fetch('insert.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `titulo=${titulo}&_titulo=${_titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}&parent=${selectedParent}`
    }).then(response => {
      if (response.ok) {
        console.log('Insertado');
        Swal.fire(
          'Insertado correctamente',
          'Puede cerrar esta ventana',
          'success', {
            timer: 5000,
        });
        response.json().then(data => {
          const indexID = data.indexID;
          const parentID = data.parentID;
          console.log(indexID);
          console.log(parentID);

          if (selectedHierarchy == 2) {
            addToIndex(indexID, parentID, 'secondary' , titulo);
          } else if (selectedHierarchy == 3) {
            addToIndex(indexID, parentID, 'terciary'  , titulo);
          } else if (selectedHierarchy == 4) {
            addToIndex(indexID, parentID, 'quaternary', titulo);
          }

        }).catch(error => {
          console.error(error);
        });
      }
    }).catch(error => {
      console.error(error);
    });

  //   fetch('insert.php', {
  //     method: 'POST',
  //     headers: {
  //       'Content-Type': 'application/x-www-form-urlencoded'
  //     },
  //     body: `titulo=${titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}&parent=${selectedParent}`
  //   }).then(response => {
  //     if (response.ok) {
  //       console.log('Insertado');
  //       Swal.fire(
  //         'Insertado correctamente',
  //         'Puede cerrar esta ventana',
  //         'success', {
  //         timer: 5000,
  //       });

  // console.log(indexID);


  //       if (selectedHierarchy == 2) {
  //         addToIndex(parentTitle, 'secondary' , titulo);
  //       } else if (selectedHierarchy == 3) {
  //         addToIndex(parentTitle, 'terciary'  , titulo);
  //       } else if (selectedHierarchy == 4) {
  //         addToIndex(parentTitle, 'quaternary', titulo);
  //       }
  //     }
  //   });
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
  const _titulo = titulo.split(" ").join("_");

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
          body: `id=${id}&titulo=${titulo}&_titulo=${_titulo}&hierarchy=${selectedHierarchy}`
        }).then(response => {
          if (response.ok) {
            Swal.fire(
              'Eliminado exitosamente',
              'Puede cerrar esta ventana',
              'success', {
              timer: 5000,
            });
          }
        });
      }
    });
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
  console.log(contenido)
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  const _title = titulo.split(" ").join("_");

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
          body: `id=${id}&titulo=${titulo}&_titulo=${_title}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
        }).then(response => {
          if (response.ok) {
            console.log('Editado');
            Swal.fire(
              'Modificado existosamente',
              'Puede cerrar esta ventana',
              'success', {
              timer: 5000,
            });
          }
        });
      }
    })
  };
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
    
    let allowedTypes = /^image\/(jpg|jpeg|png|gif|webp|tiff|bmp|svg|ico|apng)$/;
    if (!allowedTypes.test(img.type)){
      Swal.fire(
        'Formato de imagen inválido',
        'Debe tener extension .jpg, .jpeg, .png, .webp, .tiff, .svg o .gif',
        'warning', {
        timer: 5000,
      });
      console.log('formato inválido')
    } else {
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
              Swal.fire(
                'Error al subir la imagen',
                'Puede cerrar esta ventana',
                'error', {
                timer: 5000,
              });
          throw new Error('Error al subir la imagen');
        }
      }).then(data => {
        console.log(data.message);
      }).catch(error => {
        Swal.fire(
          'Error al subir la imagen',
          'Puede cerrar esta ventana',
          'error', {
          timer: 5000,
        });
        console.error(error.message);
      });
    }

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
  printFile(title);
});

function printFile(filename, title, parent) {
  let file = filename;
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
    if (result.isConfirmed && result.ok) {
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

function primaryToIndex(title, _title, category, dataset) {
  console.log(dataset);
  const index = document.querySelector('.indice');
  const treeview = index.querySelectorAll('.treeview');
  const parentIndex = document.getElementsByClassName('box-indice');
  if (category == 'primary') {
    const ul = document.createElement('ul');

    const li = document.createElement('li');
    const span = document.createElement('span');
    const template = document.createElement('ul');

    ul.id = 'myUL';
    ul.className = 'treeview';

    template.className = 'nested';
    template.dataset.parent = 'p-' + dataset;
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

function addToIndex(indexID, parentID, category, title) {
  let parentElement;
  if (category == 'secondary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'p-'+parentID}"]`);
  } else if (category == 'terciary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'s-'+parentID}"]`);
  } else if (category == 'quaternary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'t-'+parentID}"]`);
  }
  const template = document.createElement('ul');
  console.log(indexID, " ", parentID)
  if (parentElement) {
    const newElement = document.createElement("li");
    const a = document.createElement('a');
    a.href = '#';
    a.textContent = title;
    
    newElement.appendChild(a);
    if (category == 'secondary') {
      a.id = "s-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 's-' + indexID;
      template.dataset.category = 'terciary';

      newElement.appendChild(template);
      parentElement.appendChild(newElement);
    } else if (category == 'terciary') {
      a.id = "t-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 't-' + indexID;
      template.dataset.category = 'quaternary';

      newElement.appendChild(template)
      parentElement.appendChild(newElement);
    } else if (category == 'quaternary') {
      a.id = "c-" + indexID;
      parentElement.appendChild(newElement)
    } else {
      console.log('error');
    }
  }
  createIndex();
}

function createIndex() {
  let cont = document.getElementById('indice-importado').innerHTML;
  fetch(
    'edit_nav.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `cont=${cont}`
    }
  ).then(response => {
    if (response.ok) {
      console.log('creado');
    } else {
      Swal.fire(
        'Error al subir la imagen',
        'Puede cerrar esta ventana',
        'error', {
        timer: 5000,
      });
      console.log('error');
    }
  }); 
}

// function removeFromIndex(category, parentId, childId) {
//   const parentElement = document.querySelector(`[data-category="${category}"][data-parent="${parentId}"]`);
//   if (parentElement) {
//     const childElement = parentElement.querySelector(`[id="${childId}"]`);
//     if (childElement) {
//       childElement.remove();
//       createIndex();
//     }
//   }
// }

// function removeFromIndex(id) {
//   const element = document.getElementById(id);
//   const category = element.dataset.category;
//   const parent = element.dataset.parent;
//   element.remove();

//   if (category === 'quaternary') {
//     const parentElement = document.querySelector(`[data-category="terciary"][data-parent="${parent}"]`);
//     if (parentElement.querySelectorAll('li').length === 0) {
//       parentElement.remove();
//     }
//   } else if (category === 'terciary') {
//     const parentElement = document.querySelector(`[data-category="secondary"][data-parent="${parent}"]`);
//     if (parentElement.querySelectorAll('li').length === 0) {
//       parentElement.remove();
//     }
//   } else if (category === 'secondary') {
//     const parentElement = document.querySelector(`[data-category="primary"][data-parent="${parent}"]`);
//     if (parentElement.querySelectorAll('li').length === 0) {
//       parentElement.remove();
//     }
//   }

//   createIndex();
// }
function removeFromIndex(elementId) {
  const element = document.getElementById(elementId);
  if (!element) {
    console.error(`Element ${elementId} not found`);
    return;
  }
  
  const parent = element.parentNode;
  parent.removeChild(element);
  
  // If element is a secondary, tertiary or quaternary, remove its parent ul and li elements as well
  if (parent.tagName.toLowerCase() === 'ul' && parent.className.includes('nested')) {
    const grandparent = parent.parentNode;
    const siblings = grandparent.querySelectorAll('li');
    
    // If the deleted element was the only child, remove its parent ul and li elements
    if (siblings.length === 1) {
      const greatGrandparent = grandparent.parentNode;
      const greatSiblings = greatGrandparent.querySelectorAll('li');
      
      greatGrandparent.removeChild(grandparent);
      greatGrandparent.removeChild(greatSiblings[0].querySelector('a'));
      greatGrandparent.removeChild(greatSiblings[0]);
    } else {
      grandparent.removeChild(element.parentNode);
    }
  }
  
  createIndex();
}