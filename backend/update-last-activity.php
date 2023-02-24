<?php

session_start();
require "../database/connection.php";


if($_SESSION['id']){
    $user_id = $_SESSION['id'];
}

$sql = "UPDATE users SET last_activity = NOW() WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
if(!$stmt->execute()){
    echo "error";
}