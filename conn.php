<?php
$conn = new mysqli("localhost", "root", "c55h32o5n4Mg", "document");

if ($conn->connect_error) {
    die("Error: ".$conn->connect_errno ." " .$conn->connect_error);
}
?>