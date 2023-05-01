

<?php

session_start();
include "../database/connection.php";

$post_id = $_POST['post_id'];

$sql = "UPDATE post SET dislike_count = dislike_count + 1 WHERE post_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $post_id);
if($stmt->execute()){
    $sql3 = "SELECT * FROM likes where post_id=?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param('s', $post_id);
    if($stmt3->execute()){
        $result3 = $stmt3->get_result();
        $liking = $result3->num_rows;
    }
}


echo $liking;