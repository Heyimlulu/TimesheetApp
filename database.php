<?php

include_once 'config.php';

// create timesheet table
$sql = "CREATE TABLE IF NOT EXISTS timesheet (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL DEFAULT CURRENT_DATE,
    AM_IN TIME NOT NULL DEFAULT '08:00',
    AM_OUT TIME NOT NULL DEFAULT '12:00',
    PM_IN TIME NOT NULL DEFAULT '13:00',
    PM_OUT TIME NOT NULL DEFAULT '17:00'
)";

$conn -> query($sql);

// create ip address table
$sql = "CREATE TABLE IF NOT EXISTS ip_address (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(15) NOT NULL,
    date DATE NOT NULL DEFAULT CURRENT_DATE
)";

$conn -> query($sql);

// create login table
$sql = "CREATE TABLE IF NOT EXISTS login (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

$conn -> query($sql);

?>