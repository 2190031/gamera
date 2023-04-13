<?php 
    $cont = $_POST['cont'];
    $newScript = $_POST['newScript'];
    echo $cont;

    file_put_contents('0.1indice_copy.html', $cont);
    file_put_contents('indice-js.php', $newScript);
    file_put_contents('indice-js.js', $newScript);

    die();
?>
