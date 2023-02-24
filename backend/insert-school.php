<?php
session_start();
require_once "../database/connection.php";


    $school = $_POST["school"];
    $faculty = $_POST["faculty"];
    $department = $_POST["department"];
    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
    }

    $sql = "UPDATE users SET school=?, faculty=?, department=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $school, $faculty, $department, $id);
    if($stmt->execute()){
        $_SESSION['school'] = $school;
        $_SESSION['faculty'] = $faculty;
        $_SESSION['department'] = $department;

        $sql1 = "INSERT INTO notification (message, user_id) VALUES('you successfully registered with Eazy Learn', ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $id);
        $stmt1->execute();
    }

