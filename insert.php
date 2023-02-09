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
        $folder = "1/";
        $file = $folder . $titulo . '.html';
        $content = $contenido;
        file_put_contents($file, $content);
      } else {
        echo "Error";
      }
    } elseif ($hierarchy === '2') {
      $query = "INSERT INTO help_sec(title,content,prim_parent) VALUES('$titulo', '$contenido', '$parent')";   
      if ($result = mysqli_query($conn, $query)) {
        echo "Insertado en 2";
        $folder = "2/";
        $file = $folder . $titulo . '.html';
        $content = $contenido;
        file_put_contents($file, $content);
      } else {
        echo "Error";
      }
    } elseif ($hierarchy === '3') {
      $query = "INSERT INTO help_ter(title,content,sec_parent) VALUES('$titulo', '$contenido', '$parent')";   
      if ($result = mysqli_query($conn, $query)) {
        echo "Insertado en 3";
        $folder = "3/";
        $file = $folder . $titulo . '.html';
        $content = $contenido;
        file_put_contents($file, $contenido);
      } else {
        echo "Error";
      }
    }
  // }
?>
