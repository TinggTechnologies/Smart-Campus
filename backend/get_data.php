<?php
session_start();
require_once "../database/connection.php";

    $gender = trim($_POST["gender"]);
    $gender = stripslashes($gender);
    $gender = htmlspecialchars($gender);

    $date_of_birth = trim($_POST["date_of_birth"]);
    $date_of_birth = stripslashes($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
    }

    $sql = "UPDATE users SET gender=?, date_of_birth=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $gender, $date_of_birth, $id);
    if($stmt->execute()){
        $_SESSION['gender'] = $gender;
        $_SESSION['date_of_birth'] = $date_of_birth;
    } else {
        echo "not registered";
    }
