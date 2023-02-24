<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}

$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_id = $_POST['user_id'];

$password = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password=? WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $password, $user_id);
$stmt->execute();