<?php
include("conn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $_titulo = $_POST['_titulo'];
  $contenido = $_POST['contenido'];

  $hierarchy = $_POST['hierarchy'];
  if (isset($hierarchy) && $hierarchy > 1) {
    $parent = $_POST['parent'];
  }

  if (!isset($titulo)) {
    echo "Favor de ingresar un titulo";
  } else if (!isset($contenido)) {
    echo "Favor de ingresar contenido en el articulo";
  } else if ($hierarchy === '0') {
    $query = "INSERT INTO help_par(title,content) VALUES('$titulo', '$contenido')";
    if ($result = mysqli_query($conn, $query)) {
      $folder = "0/";
      $file = $folder . $_titulo . '.html';
      $update = "UPDATE help_par SET filename = '$file' WHERE title = '$titulo' AND content='$contenido'";
      $conn->query($update);
      $content = $contenido;
      file_put_contents($file, $content);
      $select = "SELECT id FROM help_par WHERE filename = '$file'";
      if ($resultSel = mysqli_query($conn, $select)) {
        $_id = $resultSel->fetch_assoc();
        $indexID = $_id['id'];
        echo json_encode(array('indexID' => $indexID));
      }
    } else {
      $error = mysqli_error($conn);
      if (strpos($error, 'Duplicate entry') !== false) {
        echo "Este registro ya existe, por favor coloque un contenido diferente.";
      } else {
        echo "Ha ocurrido un error.";
      }
    }
  } else {
    if ($hierarchy === '1') {
      $verification = "SELECT title, content FROM help WHERE title = '$titulo' AND content = '$contenido'";
      $verificate = $conn->query($verification);

      if ($verificate->num_rows > 0) {
        http_response_code(409); // Código de estado HTTP 409 (Conflicto)
        header('Content-Type: application/json');
        echo json_encode(array('error' => "Se ha encontrado un registro con estos datos, por favor cambiar el titulo o contenido sean diferentes."));
        exit(); // Detener la ejecución del script después de enviar la respuesta
      } elseif ($verificate->num_rows == 0) {
        $query = "INSERT INTO help(title,content) VALUES('$titulo', '$contenido')";
        if ($result = mysqli_query($conn, $query)) {
          $folder = "1/";
          $file = $folder . $_titulo . '.html';
          $update = "UPDATE help SET filename = '$file' WHERE title = '$titulo' AND content='$contenido'";
          $conn->query($update);
          $content = "
<html>
  <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='robots' content='noindex'>
    <meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate'>
    <meta http-equiv='Pragma' content='no-cache'>
    <meta http-equiv='Expires' content='0'>
  </head>
  <body>
    <div id='content-wrapper'>
      ".$contenido."
    </div>
  </body>
</html>
          ";
          file_put_contents($file, $content);
          $select = "SELECT id FROM help WHERE filename = '$file'";
          if ($resultSel = mysqli_query($conn, $select)) {
            $_id = $resultSel->fetch_assoc();
            $indexID = $_id['id'];

            header('Content-Type: application/json');
            echo json_encode(array('indexID' => $indexID, 'parentID' => '1'));
            // echo json_encode(array('indexID' => $indexID));
          }
        }
      }
    } elseif ($hierarchy === '2') {
      $verification = "SELECT title, content FROM help_sec WHERE title = '$titulo' AND content = '$contenido'";

      $verificate = $conn->query($verification);

      if ($verificate->num_rows > 0) {
        http_response_code(409); // Código de estado HTTP 409 (Conflicto)
        header('Content-Type: application/json');
        echo json_encode(array('error' => "Se ha encontrado un registro con estos datos, por favor cambiar el titulo o contenido sean diferentes."));
        exit(); // Detener la ejecución del script después de enviar la respuesta
      } elseif ($verificate->num_rows == 0) {
        $query = "INSERT INTO help_sec(title,content,prim_parent) VALUES('$titulo', '$contenido', '$parent')";
        if ($result = mysqli_query($conn, $query)) {
          $query_name = "SELECT help.id, help.title FROM help WHERE help.id = '$parent';";
          $result2 = $conn->query($query_name);
          if ($result2->num_rows > 0) {
            $folder = "2/";
            $parName = $result2->fetch_assoc();

            $_parName = str_replace(' ', '_', $parName['title']);
            $file = $folder . $_titulo . "-PN-" . $_parName . '.html';
            $update = "UPDATE help_sec SET filename = '$file' WHERE title = '$titulo' AND content='$contenido'";
            $conn->query($update);
          }
          $content = $contenido;
          file_put_contents($file, $content);
          $select = "SELECT id FROM help_sec WHERE filename = '$file'";
          if ($resultSel = mysqli_query($conn, $select)) {
            $_id = $resultSel->fetch_assoc();
            $indexID = $_id['id'];
            $parentID = $parName['id'];

            header('Content-Type: application/json');
            echo json_encode(array('indexID' => $indexID, 'parentID' => $parentID));
          }
        } else {
          echo "Error";
        }
      }
    } elseif ($hierarchy === '3') {
      $verification = "SELECT title, content FROM help WHERE title = '$titulo AND content = $contenido'";

      $verificate = $conn->query($verification);

      if ($verificate->num_rows > 0) {
        http_response_code(409); // Código de estado HTTP 409 (Conflicto)
        header('Content-Type: application/json');
        echo json_encode(array('error' => "Se ha encontrado un registro con estos datos, por favor cambiar el titulo o contenido sean diferentes."));
        exit(); // Detener la ejecución del script después de enviar la respuesta
      } elseif ($verificate->num_rows == 0) {
        $query = "INSERT INTO help_ter(title,content,sec_parent) VALUES('$titulo', '$contenido', '$parent')";
        if ($result = mysqli_query($conn, $query)) {
          $query_name = "SELECT help_sec.id, help_sec.title FROM help_sec WHERE help_sec.id = '$parent';";
          $result2 = $conn->query($query_name);
          if ($result2->num_rows > 0) {
            $folder = "3/";
            $parName = $result2->fetch_assoc();

            $_parName = str_replace(' ', '_', $parName['title']);
            $file = $folder . $_titulo . "-PN-" . $_parName . '.html';
            $update = "UPDATE help_ter SET filename = '$file' WHERE title = '$titulo' AND content='$contenido'";
            $conn->query($update);
          }
          $content = $contenido;
          file_put_contents($file, $content);
          $select = "SELECT id FROM help_ter WHERE filename = '$file'";
          if ($resultSel = mysqli_query($conn, $select)) {
            $_id = $resultSel->fetch_assoc();
            $indexID = $_id['id'];
            $parentID = $parName['id'];

            header('Content-Type: application/json');
            echo json_encode(array('indexID' => $indexID, 'parentID' => $parentID));
          }
        } else {
          echo "Error";
        }
      }
    } elseif ($hierarchy === '4') {
      $verification = "SELECT title, content FROM help WHERE title = '$titulo' AND content = '$contenido'";

      $verificate = $conn->query($verification);

      if ($verificate->num_rows > 0) {
        http_response_code(409); // Código de estado HTTP 409 (Conflicto)
        header('Content-Type: application/json');
        echo json_encode(array('error' => "Se ha encontrado un registro con estos datos, por favor cambiar el titulo o contenido sean diferentes."));
        exit(); // Detener la ejecución del script después de enviar la respuesta
      } elseif ($verificate->num_rows == 0) {

        $query = "INSERT INTO help_cuat(title,content,ter_parent) VALUES('$titulo', '$contenido', '$parent')";
        if ($result = mysqli_query($conn, $query)) {

          $query_name = "SELECT help_ter.id, help_ter.title FROM help_ter WHERE help_ter.id = '$parent';";
          $result2 = $conn->query($query_name);
          if ($result2->num_rows > 0) {
            $folder = "4/";
            $parName = $result2->fetch_assoc();

            $_parName = str_replace(' ', '_', $parName['title']);
            $file = $folder . $_titulo . "-PN-" . $_parName . '.html';
            $update = "UPDATE help_cuat SET filename = '$file' WHERE title = '$titulo' AND content='$contenido'";
            $conn->query($update);
          }
          $content = $contenido;
          file_put_contents($file, $contenido);
          $select = "SELECT id FROM help_cuat WHERE filename = '$file'";
          // $conn->query($select);
          if ($resultSel = mysqli_query($conn, $select)) {
            $_id = $resultSel->fetch_assoc();
            // echo $_id['id'];
            $indexID = $_id['id'];
            $parentID = $parName['id'];

            header('Content-Type: application/json');
            echo json_encode(array('indexID' => $indexID, 'parentID' => $parentID));
          }
        } else {
          echo "Error";
        }
      }
    }
  }
}
?>

