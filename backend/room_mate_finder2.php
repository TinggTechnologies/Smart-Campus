<?php

session_start();
include "../database/connection.php";

$status = $_POST['status'];
$user_id = $_POST['user_id'];

$sql = "UPDATE roommate_finder SET employment_status=? WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $status, $user_id);
$stmt->execute();