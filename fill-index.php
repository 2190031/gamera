<?php
require('conn.php');

    $query = "SELECT * FROM help";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rows[]=$row;

        echo "
        <input id='$row[id]' type='radio' value='".$row['content']."' name='helpDoc' 
        onchange='showTitleAndCont(`".$row['title']."`, this.value)' hidden>
        <a href='#content' class='link-primary' id='scroll-nav-link' onclick='
            document.getElementById(".$row['id'].").checked = true;
            var event = new Event(`change`);
            document.getElementById(`$row[id]`).dispatchEvent(event);
        ' style='line-height: 40px; margin-bottom: 10px;'>".$row['title']."</a>
        <button type='button' class='btn btn-primary btn-sm' id='scroll-nav-btn' style='float: right; margin: 0px;' onclick='editCont(`".$row['id']."`, `".$row['title']."`, `". $row['content']."`)'>Editar</button>
        <br>";
        }
    } else {
        echo "no results";
    }
?>