<?php 
    $newScript = $_POST['newScript'];

    file_put_contents('js/indice-js.js', $newScript);
?>
