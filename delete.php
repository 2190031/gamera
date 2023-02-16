<?php
include("conn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$titulo = $_POST['titulo']; 
$hierarchy = $_POST['hierarchy'];

  if ($hierarchy === "1") {
    
    $query = "DELETE FROM help WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 1";

      $folder = "1/";
      $file = $folder . $titulo . '.html';
      if (file_exists($file)) {
        unlink($file);
        echo "El archivo ha sido eliminado.";
      } else {
        echo "El archivo no existe.";
      }
    } else {
      echo "Error";
    }
  } elseif ($hierarchy === "2") {
    $query = "DELETE FROM help_sec WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 2";
      
      $folder = "2/";
      $file = $folder . $titulo . '.html';
      if (file_exists($file)) {
        unlink($file);
        echo "El archivo ha sido eliminado.";
      } else {
        echo "El archivo no existe.";
      }
    } else {
      echo "Error";
    }
  } elseif ($hierarchy === "3") {
    $query = "DELETE FROM help_ter WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 3";

      $folder = "3/";
      $file = $folder . $titulo . '.html';
      if (file_exists($file)) {
        unlink($file);
        echo "El archivo ha sido eliminado.";
      } else {
        echo "El archivo no existe.";
      }
    } else {
      echo "Error";
    }
  } elseif ($hierarchy === "4") {
    $query = "DELETE FROM help_cuart WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 4";

      $folder = "4/";
      $file = $folder . $titulo . '.html';
      if (file_exists($file)) {
        unlink($file);
        echo "El archivo ha sido eliminado.";
      } else {
        echo "El archivo no existe.";
      }
    } else {
      echo "Error";
    }
  }
}

?>