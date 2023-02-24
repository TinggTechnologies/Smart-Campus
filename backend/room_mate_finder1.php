<?php

session_start();
include "../database/connection.php";

$profile = $_POST['profile'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO roommate_finder(hostel_profile, user_id) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $profile, $user_id);
$stmt->execute();