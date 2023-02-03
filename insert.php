<?php
  include("conn.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $query = "INSERT INTO help(title,content) VALUES('$titulo', '$contenido')";   
    if ($result = mysqli_query($conn, $query)) {
      // echo "<p id='query'>$query</p>";
    } else {
      echo "Error";
    }
  }
?>
