<?php

include_once 'config.php';

// create table timesheet
$sql = "CREATE TABLE IF NOT EXISTS timesheet (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL DEFAULT CURRENT_DATE,
    AM_IN TIME NOT NULL DEFAULT '08:00',
    AM_OUT TIME NOT NULL DEFAULT '12:00',
    PM_IN TIME NOT NULL DEFAULT '13:00',
    PM_OUT TIME NOT NULL DEFAULT '17:00'
)";

$conn -> query($sql);

?>