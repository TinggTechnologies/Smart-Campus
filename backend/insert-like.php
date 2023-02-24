<?php

session_start();
include "../database/connection.php";

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];


$sql = "INSERT INTO likes (post_id, user_id) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $post_id, $user_id);
if($stmt->execute()){
    echo "<script>href.location = 'comments.php';</script>";
}