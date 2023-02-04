<?php
  include("conn.php");
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $hierarchy = $_POST['hierarchy'];
    $parent = $_POST['parent'];

    if ($hierarchy === '1') {
      $query = "INSERT INTO help(title,content) VALUES('$titulo', '$contenido')";   
      if ($result = mysqli_query($conn, $query)) {
        echo "Insertado en 1";
      } else {
        echo "Error";
      }
    } elseif ($hierarchy === '2') {
      $query = "INSERT INTO help_sec(title,content,prim_parent) VALUES('$titulo', '$contenido', '$parent')";   
      if ($result = mysqli_query($conn, $query)) {
        echo "Insertado en 2";
      } else {
        echo "Error";
      }
    } elseif ($hierarchy === '3') {
      $query = "INSERT INTO help_ter(title,content,sec_parent) VALUES('$titulo', '$contenido', '$parent')";   
      if ($result = mysqli_query($conn, $query)) {
        echo "Insertado en 3";
      } else {
        echo "Error";
      }
    }
  // }
?>
