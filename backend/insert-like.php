<?php

session_start();
include "../database/connection.php";

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];


$sql1 = "SELECT * FROM likes WHERE post_id=? AND user_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('ss', $post_id, $user_id);
if($stmt1->execute()){
    $result = $stmt1->get_result();
    if($result->num_rows > 0){
        $sql2 = "DELETE FROM likes WHERE post_id=? AND user_id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('ss', $post_id, $user_id);
        $stmt2->execute();
    }else {


        $sql = "INSERT INTO likes (post_id, user_id) VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $post_id, $user_id);
        if($stmt->execute()){
            echo "<script>href.location = 'comments.php';</script>";
        }
        }

} 