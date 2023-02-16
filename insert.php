<?php
  include("conn.php");
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $hierarchy = $_POST['hierarchy'];
    if (isset($hierarchy) && $hierarchy > 1){
      $parent = $_POST['parent'];
    } 

    if (!isset($titulo)) {
      echo "
      <script>
        swal('Error', 'Favor de ingresar un titulo', 'error');
      </script>
      ";
    } else if (!isset($contenido)) {
      echo "
      <script>
        swal('Error', 'Favor de ingresar contenido en el articulo', 'error');
      </script>
      ";
    } else if ($hierarchy === 0) {
      echo "
      <script>
        swal('Error', 'Favor de seleccionar una categoria para el articulo', 'error');
      </script>
      ";
    } else {
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
        $query_name="SELECT help.title FROM help, help_sec WHERE help_sec.prim_parent = help.id;";
        $result2 = $conn->query($query_name);
        if ($result2->num_rows > 0) {
          $parName = $result2->fetch_assoc();
        }

        $query = "INSERT INTO help_sec(title,content,prim_parent) VALUES('$titulo', '$contenido', '$parent')";   
        if ($result = mysqli_query($conn, $query)) {
          echo "Insertado en 2";
    
          $folder = "2/";
          $file = $folder . $titulo . "-PN" . $parName['title'] . '.html';
          $content = $contenido;
          file_put_contents($file, $content);
        } else {
          echo "Error";
        }
      } elseif ($hierarchy === '3') {
        $query_name="SELECT help_sec.title FROM help_sec, help_ter WHERE help_ter.sec_parent = help_sec.id;";
        $result2 = $conn->query($query_name);
        if ($result2->num_rows > 0) {
          $parName = $result2->fetch_assoc();
        }

        $query = "INSERT INTO help_ter(title,content,sec_parent) VALUES('$titulo', '$contenido', '$parent')";   
        if ($result = mysqli_query($conn, $query)) {
          echo "Insertado en 3";
  
          $folder = "3/";
          $file = $folder . $titulo . "-PN" . $parName['title'] . '.html';
          $content = $contenido;
          file_put_contents($file, $contenido);
        } else {
          echo "Error";
        }
      } elseif ($hierarchy === '4') {
        $query_name="SELECT help_ter.title FROM help_ter, help_cuat WHERE help_cuat.ter_parent = help_ter.id;";
        $result2 = $conn->query($query_name);
        if ($result2->num_rows > 0) {
          $parName = $result2->fetch_assoc();
        }

        $query = "INSERT INTO help_cuat(title,content,ter_parent) VALUES('$titulo', '$contenido', '$parent')";   
        if ($result = mysqli_query($conn, $query)) {
          echo "Insertado en 4";
  
          $folder = "4/";
          $file = $folder . $titulo . "-PN" . $parName['title'] . '.html';
          $content = $contenido;
          file_put_contents($file, $contenido);
        } else {
          echo "Error";
        }
      }
    } 
?>
