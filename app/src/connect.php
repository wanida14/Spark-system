<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'spark_system';

$conn = mysqli_connect($server, $username, $password, $database);
mysqli_set_charset($conn,"utf8");

?>