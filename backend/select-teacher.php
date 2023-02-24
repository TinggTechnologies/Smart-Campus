<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$assignment_id = $_POST['assignment_id'];
$teacher_id = $_POST['teacher_id'];


$sql = "UPDATE assigment SET teacher_id=?, status='active' WHERE assignment_code=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $teacher_id, $assignment_id);
if($stmt->execute()){
    $message = "A student has picked you to work on his/her assignment, check the Teachers Dashboard for more details";
    $sql1 = "INSERT INTO notification (user_id, message) VALUES(?,?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('ss', $teacher_id, $message);
    $stmt1->execute();
}