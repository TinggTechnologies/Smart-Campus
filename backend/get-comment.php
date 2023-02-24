<?php

session_start();
include "../database/connection.php";

$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];


$sql = "INSERT INTO comment(post_id, comment, user_id) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $post_id, $comment, $user_id);
$stmt->execute();