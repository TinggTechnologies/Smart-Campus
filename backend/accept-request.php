<?php

session_start();
include "../database/connection.php";

$friend_id = $_POST['friend_id'];
$user_id = $_POST['user_id'];


$sql = "UPDATE friends SET status='f' WHERE friend_id=? AND user_id=? AND status='p'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $user_id, $friend_id);
if($stmt->execute()){
    $sql1 = "INSERT INTO friends (friend_id, user_id, status) VALUES(?,?,'f')";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('ss', $friend_id, $user_id);
    $stmt1->execute();
}