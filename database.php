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
);";

$sql .= "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL
);";

// create an allocation table for the timesheet table to the users table
$sql .= "CREATE TABLE IF NOT EXISTS timesheet_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    timesheet_id INT(6) UNSIGNED NOT NULL,
    user_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (timesheet_id) REFERENCES timesheet(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);";

$conn -> multi_query($sql);
