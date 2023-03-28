<?php 
    $cont = $_POST['cont'];
    echo $cont;

    file_put_contents('0.1indice_copy.html', $cont);
?>
