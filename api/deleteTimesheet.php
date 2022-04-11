<?php

include_once '../config.php';

// get the id from body
$id = $_POST['id'];

$sql = "DELETE FROM timesheet WHERE id = $id";

$conn -> query($sql);

?>