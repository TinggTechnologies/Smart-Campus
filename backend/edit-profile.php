<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$date = $_POST['date'];
$gender = $_POST['gender'];
$school = $_POST['school'];
$faculty = $_POST['faculty'];
$department = $_POST['department'];

$sql = "UPDATE users SET firstname=?, lastname=?, email=?, telephone=?, date_of_birth=?, gender=?, school=?, faculty=?, department=?  WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssssss', $firstname, $lastname, $email, $telephone, $date, $gender, $school, $faculty, $department, $id);
if($stmt->execute()){
    $notification = $lastname . " " . $firstname . " just updated his profile";
    $sql1 = "INSERT INTO notification(user_id , message) VALUES('admin',?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('s', $notification);
    $stmt1->execute();
    $_SESSION['lastname'] = $lastname;
    $_SESSION['firstname'] = $firstname;
}