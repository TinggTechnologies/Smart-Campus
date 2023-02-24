<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$budget = $_POST['budget'];
$time = $_POST['time'];

$sql = "UPDATE roommate_finder SET budget=?, hostel_date=? WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $budget, $time, $id);
$stmt->execute();