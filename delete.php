<?php
include("conn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$hierarchy = $_POST['hierarchy'];

  if ($hierarchy === "1") {
    
    $query = "DELETE FROM help WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 1";
    } else {
      echo "Error";
    }
  } elseif ($hierarchy === "2") {
    $query = "DELETE FROM help_sec WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 2";
    } else {
      echo "Error";
    }
  } elseif ($hierarchy === "3") {
    $query = "DELETE FROM help_ter WHERE id = '$id'";   
    if ($result = mysqli_query($conn, $query)) {
      echo "Eliminado en 3";
    } else {
      echo "Error";
    }
  }
}

?>