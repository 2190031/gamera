<?php
include("conn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];

$query = "DELETE FROM help WHERE id = '$id'";   
if ($result = mysqli_query($conn, $query)) {
  // echo "<p id='query'>$query</p>";
} else {
  echo "Error";
}
}
?>