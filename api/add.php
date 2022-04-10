<?php

include_once '../config.php';

// get all datas in body
$user = $_POST['user'];
$userID = $_POST['userID'];
$message = $_POST['message'];

$sql = "INSERT INTO logs (user, userID, message) VALUES ('$user', '$userID', '$message')";

$conn -> query($sql);

?>