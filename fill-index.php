<?php
require('conn.php');

    $query = "SELECT * FROM help";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rows[]=$row;
        echo "
        <input id='$row[id]' type='radio' value='$row[content]' name='helpDoc' onchange=showDocs(this.value)>
        <a href='' class='link-primary' onclick=showDocs(this.value)>".$row['id']."</a><br>";
        }
    } else {
        echo "no results";
    }
?>