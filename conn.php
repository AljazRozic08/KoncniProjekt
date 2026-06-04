<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "evidenca_treningov";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Povezava ni uspela: " . mysqli_connect_error());
}



?>
