<?php

session_start();
include "../database/connection.php";

$user_id = $_POST['user_id'];
$friend_id = $_POST['friend_id'];

$sql1 = "SELECT * FROM friends WHERE (user_id=? AND friend_id=?) OR (friend_id=? AND user_id=?)";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('ssss', $friend_id, $user_id, $friend_id, $user_id);
if($stmt1->execute()){
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
        echo "You two are already friends. Check your friends listto chat the user up.";

    }  else {

        $sql = "INSERT INTO friends (friend_id, user_id, status) VALUES(?,?, 'f')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $friend_id, $user_id);
if($stmt->execute()){
    $sql = "INSERT INTO friends (user_id, friend_id, status) VALUES(?,?, 'f')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $friend_id, $user_id);
    $stmt->execute();
}

    }
    
        }

