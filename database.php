<?php

include_once 'config.php';

// create table timesheet
$sql = "CREATE TABLE IF NOT EXISTS timesheet (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL DEFAULT CURRENT_DATE,
    AM_IN TIME NOT NULL,
    AM_OUT TIME NOT NULL,
    PM_IN TIME NOT NULL,
    PM_OUT TIME NOT NULL
)";

$conn -> query($sql);

?>