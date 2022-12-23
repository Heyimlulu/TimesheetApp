<?php

include_once '../config.php';

// get all datas from body
$date = $_POST['date'];
$AM_IN = $_POST['AM_IN'];
$AM_OUT = $_POST['AM_OUT'];
$PM_IN = $_POST['PM_IN'];
$PM_OUT = $_POST['PM_OUT'];

// get the user id from session
$user_id = $_SESSION['user']['id'];

$sql = "INSERT INTO timesheet (date, AM_IN, AM_OUT, PM_IN, PM_OUT)
VALUES ('$date', '$AM_IN', '$AM_OUT', '$PM_IN', '$PM_OUT');";

$sql .= "INSERT INTO timesheet_users (user_id, timesheet_id)
VALUES ($user_id, (SELECT t.id FROM timesheet AS t ORDER BY t.id DESC LIMIT 1));";

$conn -> multi_query($sql);