<?php
session_start();
require "../database/connection.php";

$post_id = $_POST['post_id'];

$sql = "SELECT * FROM likes WHERE post_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $post_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    echo ($result->num_rows);
      
    
}