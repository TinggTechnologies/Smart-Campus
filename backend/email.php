<?php
session_start();
require_once "../database/connection.php";

if(isset($_POST["btn"])){

    $email = trim($_POST["email"]);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $phone = trim($_POST["phone"]);
    $phone = stripslashes($phone);
    $phone = htmlspecialchars($phone);

    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
    }

    $sql1 = "SELECT * FROM users WHERE email=?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $result = $stmt1->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        @$emails = $row['email'];
    }

    if($email == @$emails){
        echo "yes";
    } else {
        echo "no";
    }


    $sql = "UPDATE users SET email=?, telephone=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $email, $phone, $id);
    if($stmt->execute()){
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
    } else {
        echo "not registered";
    }

}