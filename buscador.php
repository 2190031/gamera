
<?php

$search_query = $_POST["search_query"];

if (strlen($search_query) < 3) {
    die();
}

$folders = array("1", "2", "3", "4"); // carpetas donde se hará la búsqueda

$results = array();

foreach ($folders as $folder) {
    $files = glob($folder . '/*.html'); // patrón de búsqueda para archivos HTML en la carpeta actual
    foreach ($files as $file) {
        $content = file_get_contents($file); // obtener el contenido del archivo
        if (stripos($content, $search_query) !== false) { // buscar el texto dentro del contenido del archivo
            $title = basename($file, ".html"); // título del archivo sin la extensión que contiene el texto que se introdujo en la barra de búsqueda
            $result = array(
                'title' => $title,
                'path' => $file
            );
            array_push($results, $result);
        }
    }
}

echo json_encode($results);

?>