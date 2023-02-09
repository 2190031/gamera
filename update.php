<?php 
include('conn.php');

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$hierarchy = $_POST['hierarchy'];

if ($hierarchy === "1") {
    $query = "UPDATE help SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "//1//" . $titulo . '.html';
    file_put_contents($file, $newContent);
} elseif ($hierarchy === "2") {
    $query = "UPDATE help_sec SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "//2//" . $titulo . '.html';
    file_put_contents($file, $newContent);
} elseif ($hierarchy === "3") {
    $query = "UPDATE help_ter SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    file_put_contents($file, $newContent);
} 
?>