<?php

// Database connection
$hostname = 'localhost';
$username = 'root';
$password = null;
$database = 'employeedb';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>