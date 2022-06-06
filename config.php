<?php

// Database connection
$hostname = 'kh251.myd.infomaniak.com';
$username = 'kh251_timesheet';
$password = 'mxyA-f9mfU6';
$database = 'kh251_timesheetdb';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>