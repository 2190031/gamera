// Función para cargar un archivo y obtener su contenido HTML
function cargarHTML(url, exito, error) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          exito(xhr.responseText);
        } else {
          error(xhr);
        }
      }
    };
    xhr.open("GET", url, true);
    xhr.send();
  }



// Array de títulos
var titulos = ["Funcionamiento general", "Ventana de listado tipo simple", "Ventana de listado con filtro de datos", 
"Elementos comunes de las ventanas", "Ventana de reportes", "Estaciones", "Zonas", "Usuarios", "Permisos"];

// Obtener elementos
var input = document.getElementById("buscador");
var resultados = document.getElementById("resultados");

// Función para buscar títulos
function buscarTitulos() {
  // Obtener entrada del usuario y convertirla a minúsculas y reemplazar los espacios por guiones bajos para uso interno
  var busqueda = input.value.toLowerCase();

  // Comprobar si la entrada del usuario tiene al menos 3 caracteres
  if (busqueda.length < 3) {
    // Limpiar resultados anteriores
    resultados.innerHTML = "";
    // Ocultar resultados
    resultados.style.display = "none";
    // Salir de la función sin realizar la búsqueda
    return;
  }

  // Limpiar resultados anteriores
  resultados.innerHTML = "";

  // Mostrar títulos coincidentes
  for (var i = 0; i < titulos.length; i++) {
    // Convertir el título actual a minúsculas
    var titulo = titulos[i].toLowerCase();
    
    // Comprobar si la entrada del usuario coincide con el título
    if (titulo.indexOf(busqueda) >= 0) {
      // Crear elemento de lista para mostrar el título
      var elementoLista = document.createElement("li");
      elementoLista.textContent = titulos[i];
      
      // Añadir evento de clic al elemento de lista para inyectar código HTML
      elementoLista.onclick = function() {
        // Buscar el archivo y cargar su contenido HTML
        cargarHTML(this.textContent.toLowerCase().replace(/\s+/g, '_')+".html",
        function(html) {
          // Inyectar el HTML en el elemento existente
          document.getElementById("contenido").innerHTML = html;
        },
        function(xhr) {
          // Si ocurre un error, mostrar un mensaje de error
          console.error("No se pudo cargar el archivo " + xhr.status + ": " + xhr.statusText);
        });
        
        // Ocultar resultados
        resultados.style.display = "none";
      };
      
    // Añadir elemento de lista al resultado
    resultados.appendChild(elementoLista); 

    // Indicar que se encontraron resultados
    seEncontraronResultados = true;
    } 
  }
  
  // Mostrar resultados si hay coincidencias
  if (resultados.childNodes.length > 0) {
    resultados.style.display = "block";
  } else { 
    // Crear elemento de lista para mostrar el mensaje de no encontrado
    var elementoLista = document.createElement("li");
    elementoLista.textContent = "No se encontraron resultados.";
    
    // Añadir elemento de lista al resultado
    resultados.appendChild(elementoLista);
  }
}

// Asignar evento de entrada al buscador
document.getElementById("buscador").addEventListener("input", buscarTitulos);

// Asignar evento de clic al documento
document.addEventListener("click", function(event) {
  // Comprobar si se hizo clic fuera del elemento de resultados o en un elemento de la lista
  if (event.target !== resultados && !resultados.contains(event.target)) {
    // Ocultar resultados
    resultados.style.display = "none";
  }
});


