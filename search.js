function searchList() {
    // Obtén el valor del campo de entrada
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    
    // Obtén la lista y sus elementos
    let ul = document.getElementById("list");
    let li = ul.getElementsByTagName("li");
  
    // Recorre todos los elementos de la lista y oculta aquellos que no coincidan con el valor del campo de entrada
    for (let i = 0; i < li.length; i++) {
      let a = li[i];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }