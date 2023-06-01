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

document.addEventListener('DOMContentLoaded', function () {
  const base = document.querySelector('#categ-base').innerText;
  if (base !== 'No hay resultados') {
    // existe
    // console.log(base)
  } else if (base === 'No hay resultados') {
    // no existe
  }
})

function jsSave() {
  let titulo = document.getElementById("input-title").value;
  let contenido = quill.container.firstChild.innerHTML.trim();
  // contenido = "" + contenido + ""
  // console.log(contenido);
  let hierarchy = document.getElementById("select-hierarchy");
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;
  let selectedParent = "";
  let parentTitle = "";

  const base = document.querySelector('#categ-base').innerText;
  if (base !== 'No hay resultados' && selectedHierarchy == '0') {
    Swal.fire(
      'Ya existe el artículo base',
      'No puede crearse más de uno',
      'warning', {
      timer: 5000,
    }
    )
  } else {
    if (selectedHierarchy > 1) {
      parent = document.getElementById('parents');
      selectedParent = parent.value;
      let selectedOption = parent.querySelector(`option[value="${selectedParent}"]`);
      if (selectedOption !== null) {
        parentTitle = selectedOption.textContent;
      }
    }
    // console.log(selectedParent, " ", parentTitle);

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
    if (selectedParent == "") {
      fetch('insert.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `titulo=${titulo}&_titulo=${_titulo}&contenido=${contenido}&hierarchy=${selectedHierarchy}`
      }).then(response => {
        if (response.ok) {
          response.json().then(data => {
            if (response.status === 409) {
              Swal.fire(
                'Error al insertar el registro',
                data.error,
                'error'
              );
            } else {
              const indexID = data.indexID;
              console.log(indexID);
              console.log('Insertado');
              Swal.fire(
                'Creado correctamente',
                'Puede cerrar esta ventana',
                'success', {
                timer: 5000
              });
              console.log(selectedHierarchy)
              if (selectedHierarchy == '0') {
                primaryToIndex(titulo, _titulo, 'base', indexID);
                cargarIndiceJS();
              } else if (selectedHierarchy == 1) {
                addToIndex(indexID, '1', 'primary', titulo);
                cargarIndiceJS();
              }
            }
          }).catch(error => {
            Swal.fire(
              'Ha ocurrido un error',
              'Puede cerrar esta ventana',
              'error'
            );
            console.error(error);
          });
        } else {
          response.text().then(text => {
            text = text.split('"')
            Swal.fire(
              'Ha ocurrido un error',
              text[3],
              'error'
            );
            console.error(text);
          });
        }
      }).catch(error => {
        Swal.fire(
          'Ha ocurrido un error',
          error.message,
          'error'
        );
        console.error(error);
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
          response.json().then(data => {
            if (data.error == "Este registro ya existe, por favor verificar que el título o contenido sean diferentes.") {
              Swal.fire(
                data.error,
                {
                  icon: "error",
                  timer: 5000
                }
              )
            } else {
              const indexID = data.indexID;
              const parentID = data.parentID;
              console.log(indexID);
              console.log(parentID);

              if (selectedHierarchy == 2) {
                console.log(indexID, parentID)
                addToIndex(indexID, parentID, 'secondary', titulo);
                cargarIndiceJS();
              } else if (selectedHierarchy == 3) {
                addToIndex(indexID, parentID, 'terciary', titulo);
                cargarIndiceJS();
              } else if (selectedHierarchy == 4) {
                addToIndex(indexID, parentID, 'quaternary', titulo);
                cargarIndiceJS();
              }
              console.log('Insertado');
              Swal.fire(
                'Insertado correctamente',
                'Puede cerrar esta ventana',
                'success', {
                timer: 5000,
              });
            }
          }).catch(error => {
            Swal.fire(
              'Ha ocurrido un error',

              'Puede cerrar esta ventana <br>' + error,
              'error'
            );
            console.error(error);
          });
        }
      }).catch(error => {
        Swal.fire(
          'Ha ocurrido un error',

          'Puede cerrar esta ventana <br>' + error,
          'error'
        );
        console.error(error);
      });
    }
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

  if (id == null || titulo == "" || selectedHierarchy == '0') {
    if (selectedHierarchy == '0') {
      Swal.fire(
        'No puede eliminarse el artículo base',
        'Debe modificarlo o crear otros de categoría inferior',
        'warning', {
        timer: 5000
      });
    } else {
      Swal.fire(
        'Se han encontrado uno o más campos vacíos',
        'Debe seleccionar uno de los registros',
        'warning', {
        timer: 5000
      });
    }
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
            if (selectedHierarchy == "1") {
              id = "p-" + id;
              console.log(id)
              removeFromIndex(id)
            } else if (selectedHierarchy == "2") {
              id = "s-" + id;
              console.log(id)
              removeFromIndex(id)
            } else if (selectedHierarchy == "3") {
              id = "t-" + id;
              console.log(id)
              removeFromIndex(id)
            } else if (selectedHierarchy == "4") {
              id = "c-" + id;
              console.log(id)
              removeFromIndex(id)
            }
            Swal.fire(
              'Eliminado exitosamente',
              'Puede cerrar esta ventana',
              'success', {
              timer: 5000
            });
          }
        }).catch(error => {
          Swal.fire(
            'Ha ocurrido un error',

            'Puede cerrar esta ventana <br>' + error.message,
            'error'
          );
          console.error(error);
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
  console.log(hierarchy);
  console.log(hierarchy.options[hie].value);
  let selectedHierarchy = hierarchy.options[hierarchy.selectedIndex].value;

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('hidden-id').innerText = id;
    document.getElementById("input-title").value = tit;
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

            if (selectedHierarchy == "0") {
              id = "z-" + id;
              updateOnIndex(id, titulo)
            } else if (selectedHierarchy == "1") {
              id = "p-" + id;
              updateOnIndex(id, titulo)
            } else if (selectedHierarchy == "2") {
              id = "s-" + id;
              updateOnIndex(id, titulo)
            } else if (selectedHierarchy == "3") {
              id = "t-" + id;
              updateOnIndex(id, titulo)
            } else if (selectedHierarchy == "4") {
              id = "c-" + id;
              updateOnIndex(id, titulo)
            } else
              console.log(id)
            Swal.fire(
              'Modificado existosamente',
              'Puede cerrar esta ventana',
              'success', {
              timer: 5000,
            });
          }
        }).catch(error => {
          Swal.fire(
            'Ha ocurrido un error',

            'Puede cerrar esta ventana <br>' + error.message,
            'error'
          );
          console.error(error);
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

  var imgTag = '<img src="' + relativeUrl + '" class="box-img">';
  quill.clipboard.dangerouslyPasteHTML(quill.getLength(), imgTag);
}

/*
Sube una imagen de formatos especificados a la carpeta de imagenes
*/
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
    if (!allowedTypes.test(img.type)) {
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
            'Puede cerrar esta ventana <br>' + error.message,
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

          'Puede cerrar esta ventana <br>' + error.message,
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
        document.getElementById("title").innerHTML = "<h1>" + file.split("1/")[1] + "</h1>";
        document.getElementById("content").innerHTML = xhr.response;
      } else if (xhr.status === 404) {
        Swal.fire(
          'Archivo no encontrado',
          'Es posible que el archivo haya sido eliminado, cambiado el nombre o de lugar',
          'error', {
          timer: 5000
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
          timer: 5000
        });
        return;
      }
    };
  }
  xhr.send();
}

/* 
Recarga el indice al presionar boton, actualiza cambios de insercion, eliminacion y modificacion
*/

function refreshIndex() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#snav").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "fill-index.php", true);
  xhttp.send();

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#indice-js").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "js/indice-js.js", true);
  xhttp.send();
}

/* 
Elimina el texto de los campos y el editor
*/
function limpiarCampos() {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esto borrará todos los campos.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, borrar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('input-title').value = '';
      document.getElementById('hidden-id').innerText = '';
      quill.setText('');
      document.getElementById('image').value = '';
    }
  }).catch(error => {
    Swal.fire(
      'Ha ocurrido un error',

      'Puede cerrar esta ventana <br>' + error.message,
      'error'
    );
    console.error(error);
  });

};

/* 
Llama al indice y lo coloca en el div indice
*/
function cargarIndice() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var index = this.responseText.match(/<div class="indice" id="indice">[\s\S]*?<\/div>/)[0];
      document.getElementById("indice-importado").innerHTML = index;
    }
  }
  xhr.open("GET", "indice_elementos.html");
  xhr.send();
}
function cargarIndiceJS() {
  xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("indice-js").innerHTML = this.responseText;
      console.log(this.responseText);
    }
  }
  xhr.open("GET", "js/indice-js.js");
  xhr.send();
}

function cargar() {
  cargarIndice();
  cargarIndiceJS();
}
/* 
Al insertar, agrega el nuevo regitro primario al indice, actualizandolo
*/
function primaryToIndex(title, _title, category, dataset) {
  console.log(dataset);
  const index = document.querySelector('.indice');
  const treeview = index.querySelectorAll('.treeview');
  const parentIndex = document.getElementsByClassName('box-indice');
  if (category == 'base') {
    const ul = document.createElement('ul');

    const li = document.createElement('li');
    const span = document.createElement('span');
    const template = document.createElement('ul');

    ul.id = 'myUL';
    ul.className = 'treeview';

    template.className = 'nested';
    template.dataset.parent = 'z-' + dataset;
    template.dataset.category = 'primary';

    span.className = 'caret base ola1';

    ul.dataset.category = 'base';

    const a = document.createElement('a');
    a.href = '#contenido';
    a.classList = "ola text-break text-truncate";
    a.textContent = title;
    a.id = "z-" + dataset;

    span.appendChild(a);
    li.appendChild(span);
    li.appendChild(template);
    ul.appendChild(li);
    document.getElementsByClassName('box-indice')[0].appendChild(ul);
    addScriptToIndex(a.id, "0/" + title + ".html");
    createIndex();
  }
}

/*
Agrega los articulos del resto de categorias al indice, tomando en cuenta su articulo padre
*/
function addToIndex(indexID, parentID, category, title) {
  let parentElement;
  var parentName;
  if (category == 'primary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'z-' + parentID}"]`);
    parentName = parentElement.parentNode.innerText;
  } else if (category == 'secondary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'p-' + parentID}"]`);
    parentName = parentElement.parentNode.innerText;
  } else if (category == 'terciary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'s-' + parentID}"]`);
    parentName = parentElement.parentNode.innerText;
  } else if (category == 'quaternary') {
    parentElement = document.querySelector(`[data-category="${category}"][data-parent="${'t-' + parentID}"]`);
    parentName = parentElement.parentNode.innerText;
  }
  const template = document.createElement('ul');

  if (parentElement) {
    const span = document.createElement('span');
    const newElement = document.createElement("li");
    const a = document.createElement('a');
    a.href = '#contenido';
    a.classList = "ola text-break text-truncate";
    a.textContent = title;

    parentName = parentName.split(' ').join('_');
    if (category == 'primary') {
      a.id = "p-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 'p-' + indexID;
      template.dataset.category = 'secondary';

      span.className = 'caret base ola1';
      span.appendChild(a);
      newElement.appendChild(span);
      newElement.appendChild(template);
      parentElement.appendChild(newElement);

      addScriptToIndex(a.id, "1/" + title + ".html");
      createIndex()
    } else if (category == 'secondary') {
      a.id = "s-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 's-' + indexID;
      template.dataset.category = 'terciary';

      span.className = 'caret base ola1';
      span.appendChild(a);
      newElement.appendChild(span);
      newElement.appendChild(template);
      parentElement.appendChild(newElement);

      title = title + '-PN-' + parentName;
      addScriptToIndex(a.id, "2/" + title + ".html");
      createIndex()
    } else if (category == 'terciary') {
      a.id = "t-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 't-' + indexID;
      template.dataset.category = 'quaternary';

      span.className = 'caret base ola1';
      span.appendChild(a);
      newElement.appendChild(span);
      newElement.appendChild(template)
      parentElement.appendChild(newElement);

      title = title + '-PN-' + parentName;
      addScriptToIndex(a.id, "3/" + title + ".html");
      createIndex()
    } else if (category == 'quaternary') {
      a.id = "c-" + indexID;
      template.className = 'nested';
      template.dataset.parent = 'c-' + indexID;

      newElement.appendChild(a);
      parentElement.appendChild(newElement);

      title = title + '-PN-' + parentName;
      addScriptToIndex(a.id, "4/" + title + ".html");
      createIndex()
    } else {
      console.log('error');
    }
  } else {
    return "Elemento padre no encontrado en el ínidice.\nEste elemento podría no existir dentro del índice"
  }
}

/*
Agrega el codigo jquery para cada articulo en el archivo indice-js.js
*/
function addScriptToIndex(id, title) {
  filename = title.split(" ").join("_");
  var newScript = `\n$('#${id}').click(function () { $("#contenido").load("${filename}"); });`;
  /* let div = document.getElementById("indice-js");
  * let newdiv = div.innerText.split("\n");
  * newdiv.pop();
  * newdiv.push(newScript);
  * newdiv = newdiv.join("\n");
  * console.log(newdiv);
  * createIndexJS(newdiv);


  * div.innerText += '\n' + newScript; // Append the new line to the existing content

  * console.log(div.innerText);
  * createIndexJS(div.innerText);

  *
  * let div = document.getElementById("indice-js");
  * let lines = div.innerText.split("\n"); // Split the existing content into lines
  * lines.pop(); // Remove the last empty line
  * lines.push(newScript); // Append the new line to the array
  * let updatedContent = lines.join("\n"); // Join the lines back into a string

  * console.log(updatedContent);
  * createIndexJS(updatedContent);
  */

  let div = document.getElementById("indice-js");
  let lines = div.innerText.split("\n");
  lines.splice(-1, 0, newScript); // Insert the new script before the last line

  let updatedScript = lines.join("\n"); // Join the lines using newline separator

  console.log(updatedScript);
  createIndexJS(updatedScript);
}

/*
Funcion complementaria de addScriptToIndex, actualiza el cambio de agregar la nueva linea de codigo al archivo
*/
function createIndexJS(script) {
  fetch(
    'edit_nav_js.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `newScript=${script}`
  }
  ).then(response => {
    if (response.ok) {
      console.log('creado');
    } else {
      Swal.fire(
        'Error al agregar al índice',
        'Puede cerrar esta ventana <br>' + error.message,
        'error', {
        timer: 5000
      }
      );
    }
  }).catch(error => {
    Swal.fire(
      'Ha ocurrido un error',
      'Puede cerrar esta ventana <br>' + error.message,
      'error'
    );
    console.error(error);
  });
}

/*
Realiza el cambio hecho con las funciones addToIndex y primaryToIndex, haciendo definitivo el cambio en el archivo de origen
*/
function createIndex() {
  let cont = document.getElementById('indice-importado').innerHTML;

  fetch(
    'edit_nav.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `cont=${cont}`
  }
  ).then(response => {
    if (response.ok) {
      console.log('creado');
    } else {
      Swal.fire(
        'Error al agregar al índice',
        'Puede cerrar esta ventana <br>' + error.message,
        'error', {
        timer: 5000
      }
      );
    }
  }).catch(error => {
    Swal.fire(
      'Ha ocurrido un error',
      'Puede cerrar esta ventana <br>' + error.message,
      'error'
    );
    console.error(error);
  });
}

/*
Al eliminar un articulo, lo elimina tambien del indice, si este tiene articulos hijos, tambien los elimina del indice
*/
function removeFromIndex(elementId) {
  if (elementId.split('-')[0] == 'p') {
    const element = document.getElementById(elementId).parentNode.parentNode;
    let html_element = element.innerHTML;
    console.log(element)

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
    element.remove();
  } else if (elementId.split('-')[0] != 'p' && elementId.split('-')[0] != 'c') {
    const element = document.getElementById(elementId).parentNode;
    let html_element = element.innerHTML;
    console.log(element)

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
    element.remove();
  } else if (elementId.split('-')[0] == 'c') {
    const element = document.getElementById(elementId).parentElement;
    let html_element = element.innerHTML;
    console.log(element)

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
    element.remove();
  }

  createIndex();
}

/*
Al hacer una modificacion al articulo (su titulo) se actualiza en el indice
*/
function updateOnIndex(elementId, newTitle) {
  console.log(elementId)
  if (elementId.split('-')[0] == 'p') {
    let element = document.getElementById(elementId);
    let html_element = element.innerHTML;
    console.log(element);
    element.innerText = newTitle;

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
  } else if (elementId.split('-')[0] != 'p' && elementId.split('-')[0] != 'c') {
    let element = document.getElementById(elementId);
    let html_element = element.innerHTML;
    console.log(element)
    element.innerText = newTitle;

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
  } else if (elementId.split('-')[0] == 'c') {
    let element = document.getElementById(elementId);
    let html_element = element.innerHTML;
    console.log(element)
    element.innerText = newTitle;

    if (!element) {
      console.error(`Element ${elementId} not found`);
      return;
    }
  }
  createIndex();
}