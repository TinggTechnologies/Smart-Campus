<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$profile = $_POST['profile'];
$status = $_POST['status'];
$bio_data = $_POST['bio_data'];
$level = $_POST['level'];
$religion = $_POST['religion'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$budget = $_POST['budget'];
$department = $_POST['department'];
$connect = $_POST['connect'];
$time = $_POST['time'];

$sql = "UPDATE roommate_finder SET hostel_profile=?, employment_status=?, bio_data=?, level=?, religion=?, gender=?, age_range=?, budget=?, department=?, connect=?, hostel_date=?  WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssssssss', $profile, $status, $bio_data, $level, $religion, $gender, $age, $budget, $department, $connect, $time, $id);
if($stmt->execute()){
    $notification = $_SESSION['lastname'] . " " . $_SESSION['firstname'] . " just updated his profile";
    $sql1 = "INSERT INTO notification(user_id , message) VALUES('admin',?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('s', $notification);
    $stmt1->execute();
}