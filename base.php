<?php
    include_once 'conn.php';

    $sql = "SELECT content FROM help_par";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>".$row["content"]."</p>";
        }
    } else {
        echo "Todavía no se ha creado la portada. Ir al <a href='editor.php'>editor</a> para comenzar.";
    }

?>