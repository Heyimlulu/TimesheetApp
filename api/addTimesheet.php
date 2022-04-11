<?php

include_once '../config.php';

// get all datas in body
$date = $_POST['date'];
$AM_IN = $_POST['AM_IN'];
$AM_OUT = $_POST['AM_OUT'];
$PM_IN = $_POST['PM_IN'];
$PM_OUT = $_POST['PM_OUT'];

$sql = "INSERT INTO timesheet (date, AM_IN, AM_OUT, PM_IN, PM_OUT) VALUES ('$date', '$AM_IN', '$AM_OUT', '$PM_IN', '$PM_OUT')";

$conn -> query($sql);

?>