var searchInput = document.getElementById("search");
var resultsDiv = document.getElementById("results");
var contenidoDiv = document.getElementById("conten");
var timeoutId;

searchInput.addEventListener("input", function () {
    clearTimeout(timeoutId);
    var searchQuery = searchInput.value.trim();

    if (searchQuery.length < 3) {
        resultsDiv.style.display = "none";
        return;
    }

    timeoutId = setTimeout(function () {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "buscador.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var results = JSON.parse(xhr.responseText);
                    var resultsHtml = "";
                    if (results.length > 0) {
                        for (var i = 0; i < results.length; i++) {
                            resultsHtml += '<div class="result" id="' + results[i].path + '">' + results[i].title + '</div>';

                        }
                    } else {
                        resultsHtml = "No se encontraron resultados";
                    }
                    resultsDiv.innerHTML = resultsHtml;
                    resultsDiv.style.display = "block";
                } catch (e) {
                    console.error("Error al procesar la respuesta del servidor:", e);
                }
            }
        };
        xhr.send("search_query=" + searchQuery);
    }, 500);
});

document.addEventListener("click", function (event) {
    if (event.target != searchInput && event.target != resultsDiv) {
        resultsDiv.style.display = "none";
    }
});

resultsDiv.addEventListener("click", function (event) {
    if (event.target.classList.contains("result")) {
        var path = event.target.getAttribute("id");
        var xhr = new XMLHttpRequest();
        xhr.open("GET", path, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var contentHtml = xhr.responseText;
                contenidoDiv.innerHTML = contentHtml;
            }
        };
        xhr.send();
    }
});