<?php 

include_once '../config.php';

// get all datas in body
$id = $_POST['id'];
$date = $_POST['date'];
$AM_IN = $_POST['AM_IN'];
$AM_OUT = $_POST['AM_OUT'];
$PM_IN = $_POST['PM_IN'];
$PM_OUT = $_POST['PM_OUT'];

$sql = "UPDATE timesheet SET date = '$date', AM_IN = '$AM_IN', AM_OUT = '$AM_OUT', PM_IN = '$PM_IN', PM_OUT = '$PM_OUT' WHERE id = $id";

$conn -> query($sql);

