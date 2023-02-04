<?php
require('conn.php');

$hierarchy = $_REQUEST['hierarchy'];

if($hierarchy === '2'){
    $query = "SELECT * FROM help";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rows[]=$row;

        echo "<option value='".$row['id']."'>".$row['title']."</option>";
        }
    } else {
        echo "no results";
    }
} elseif($hierarchy==='3') {
    $query = "SELECT * FROM help_sec";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rows[]=$row;

        echo "<option value='".$row['id']."'>".$row['title']."</option>";
        }
    } else {
        echo "no results";
    }
} else {
    echo "error";
}
?> 