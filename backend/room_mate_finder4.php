<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$department = $_POST['department'];
$religion = $_POST['religion'];
$level = $_POST['level'];
$age = $_POST['age'];
$gender = $_POST['gender'];

$sql = "UPDATE roommate_finder SET department=?, religion=?, level=?, age_range=?, gender=? WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssss', $department, $religion, $level, $age, $gender, $id);
$stmt->execute();