<?php 
include('conn.php');

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$_titulo = $_POST['_titulo'];
$contenido = $_POST['contenido'];
$hierarchy = $_POST['hierarchy'];

echo $contenido;

if ($hierarchy === "0") {
  $query = "UPDATE help_par SET title='$titulo', content='$contenido' WHERE id='$id'";
  mysqli_query($conn, $query);
  $file = "0/" . $_titulo . '.html';
  file_put_contents($file, $contenido);
} elseif ($hierarchy === "1") {
    $query = "UPDATE help SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "1/" . $_titulo . '.html';
    file_put_contents($file, $contenido);
} elseif ($hierarchy === "2") {
    $query_name="SELECT help.title FROM help, help_sec WHERE $id = help.id;";
    $result2 = $conn->query($query_name);
    if ($result2->num_rows > 0) {
      $parName = $result2->fetch_assoc();
    }

    $query = "UPDATE help_sec SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "2/" . $_titulo . "-PN-" . $parName['title'] . '.html';
    file_put_contents($file, $contenido);
} elseif ($hierarchy === "3") {
    $query_name="SELECT help_sec.title FROM help_sec, help_ter WHERE help_ter.sec_parent = help_sec.id;";
    $result2 = $conn->query($query_name);
    if ($result2->num_rows > 0) {
      $parName = $result2->fetch_assoc();
    }

    $query = "UPDATE help_ter SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "3/" . $_titulo . "-PN-" . $parName['title'] . '.html';
    file_put_contents($file, $contenido);
} elseif ($hierarchy === "4") {
    $query_name="SELECT help_ter.title FROM help_ter, help_cuat WHERE help_cuat.ter_parent = help_ter.id;";
    $result2 = $conn->query($query_name);
    if ($result2->num_rows > 0) {
      $parName = $result2->fetch_assoc();
    }

    $query = "UPDATE help_cuat SET title='$titulo', content='$contenido' WHERE id='$id'";
    mysqli_query($conn, $query);

    $file = "4/" . $_titulo . "-PN-" . $parName['title'] . '.html';
    file_put_contents($file, $contenido);
}
?>