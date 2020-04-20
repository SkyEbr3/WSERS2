<?php
$servername ="localhost";
$username = "root";
$password = "";
$database = "mohsen";
$connect = mysqli_connect($servername, $username, $password, $database);
if (!$connect) {
    die(' Unsuccessful connection' . mysqli_connect_errno());
}

?>