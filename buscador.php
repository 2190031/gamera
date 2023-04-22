
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
        $title = basename($file, ".html"); // título del archivo sin la extensión
        if (stripos($title, $search_query) !== false) {
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