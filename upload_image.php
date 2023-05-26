<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $dir = "img/";
    $imageName = $_POST['imageName'];
    $image = $dir . $imageName;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        if (move_uploaded_file($_FILES['image']['tmp_name'],  $image)){
            $response = array('message' => 'La imagen se ha cargado correctamente.');
        } else{
            $response = array('message' => 'Ocurrió algún error al subir la imagen. No pudo guardarse.');
        }
    } else {
        $response = array('message' => 'Ocurrió algún error al subir la imagen. No pudo guardarse.');
    }
    echo json_encode($response);
}
?>