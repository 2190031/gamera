<?php

  $contenido = $_REQUEST['contenido'];
  $link = new PDO("mysql:host=localhost;dbname=document","root","c55h32o5n4Mg");
  $query = $link->prepare("INSERT INTO help(content) VALUES(:contenido)");
  $query -> execute(['contenido' => $contenido]);      
?>