<?php

session_start();
include "../database/connection.php";

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

$output = '';

$sql = "SELECT * FROM comment WHERE user_id=? AND post_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $user_id, $post_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($comment_row = $result->fetch_assoc()){
            $user_id = $comment_row['user_id'];
            $sql1 = "SELECT * FROM users WHERE user_id=?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param('s', $user_id);
            if($stmt1->execute()){
                $result1 = $stmt1->get_result();
                if($result1->num_rows > 0){
                    $rows1 = $result1->fetch_assoc(); 
                    }
                }
            $output .= '
            <div class="comments">
            <div class="individuals-comment d-flex-sb">
                    <div class="person-profile-xs">
                        <img src="'.$rows1['image'].'">
                    </div>
                    <div class="individuals">
                        <h6>'.$rows1['lastname'] .' '. $rows1['firstname'].'</h6>
                        <p>'.$comment_row['comment'].'</p> 
                    </div>
                    <div class="like">
                        <i class="bi bi-heart"></i>
                        <small class="likes-count">3</small>
                    </div>
                    </div>
                </div>
            ';
        }
    }
}
echo $output;

