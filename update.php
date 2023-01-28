<?php 
include('conn.php');

$id = $_REQUEST['id'];
$titulo = $_REQUEST['titulo'];
$contenido = $_REQUEST['contenido'];

$query = "UPDATE help SET title='$titulo', content='$contenido' WHERE id='$id'";

mysqli_query($conn, $query);
?>