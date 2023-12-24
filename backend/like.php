<?php
session_start();
include "../database/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];

    // Check if the user already liked this post
    $stmt = $conn->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param('ss', $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already liked the post, so remove the like
        $stmt = $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->bind_param('ss', $post_id, $user_id);
        if($stmt->execute()){
            $stmt1 = $conn->prepare("SELECT * FROM likes WHERE post_id = ?");
            $stmt1->bind_param('s', $post_id);
            if($stmt1->execute()){
                $likes_result = $stmt1->get_result();
                $count_likes = $likes_result->num_rows;
                echo $count_likes;
        }}
        
    } else {
        // User didn't like the post, so add a like
        $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
        $stmt->bind_param('ss', $post_id, $user_id);
        if($stmt->execute()){
            $stmt1 = $conn->prepare("SELECT * FROM likes WHERE post_id = ?");
            $stmt1->bind_param('s', $post_id);
            if($stmt1->execute()){
                $likes_result = $stmt1->get_result();
                $count_likes = $likes_result->num_rows;
                echo $count_likes;
             
        }}
    }
} else {
    echo "Invalid request.";
}

?>
