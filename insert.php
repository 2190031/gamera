<?php
  include("conn.php");
  $titulo = $_REQUEST['titulo'];
  $contenido = $_REQUEST['contenido'];

  $query = "INSERT INTO help(title,content) VALUES('$titulo', '$contenido')";   
  if ($result = mysqli_query($conn, $query)) {
    // echo "<p id='query'>$query</p>";
  } else {
    echo "Error";
  }
?>
<script>
  // console.log(document.getElementById(query).innerText);
</script>