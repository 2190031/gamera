<?php 
    $newScript = $_POST['newScript'];

    file_put_contents('indice-js.js', $newScript);
?>
