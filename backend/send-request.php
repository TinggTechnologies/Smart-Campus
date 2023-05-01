<?php

session_start();
include "../database/connection.php";

$friend_id = trim($_POST['friend_id']);
$friend_id = stripslashes($friend_id);
$friend_id = htmlspecialchars($friend_id);

$user_id = trim($_POST['user_id']);
$user_id = stripslashes($user_id);
$user_id = htmlspecialchars($user_id);


$sql = "INSERT INTO friends (friend_id, user_id, status) VALUES(?,?,'p')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $friend_id, $user_id);
if($stmt->execute()){
    $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " sent you a friend request";
    $sql = "INSERT INTO friends_request (message, sender_id, user_id) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $message, $user_id, $friend_id);
    $stmt->execute();

}