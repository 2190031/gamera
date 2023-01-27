<?php
require('conn.php');

    $query = "SELECT * FROM help";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rows[]=$row;
        // $data = json_encode($rows);
        echo "
        <input id='$row[id]' type='radio' value='".$row['content']."' name='helpDoc' 
        onchange='showTitleAndCont(`".$row['title']."`, this.value)'>
        <a class='link-primary' onclick='
            document.getElementById(".$row['id'].").checked = true;
            var event = new Event(`change`);
            document.getElementById(`$row[id]`).dispatchEvent(event);
        '>".$row['title']."</a><br>";
        }
    } else {
        echo "no results";
    }
?>