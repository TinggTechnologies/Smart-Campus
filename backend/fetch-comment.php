<?php
session_start();
require "../database/connection.php";

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
 }

$output = '';
$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

$sql = "SELECT * FROM comment WHERE post_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $post_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $rows1 = $result1->fetch_assoc(); 
                $sql = "SELECT * FROM likes WHERE post_id='$post_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $likes_result = $stmt->get_result();
                $count_likes = $likes_result->num_rows;
                $sql4 = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$user_id'";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->execute();
                $likes_result4 = $stmt4->get_result();
                if($likes_result4->num_rows > 0){
                  $click_likes = "bi bi-heart-fill";
                } else {
                  $click_likes = "bi bi-heart";
                }
            

                }
            }

$output .= '

<div class="individuals-comment d-flex-sb">
<div class="person-profile-xs">
    <img src="'.$rows1['image'].'">
</div>
<div class="individuals">
    <h6>'.$rows1['lastname']. ' ' .$rows1['firstname'].'</h6>
    <p>'.$rows['comment'].'</p>
</div>

</div>

';

} }}

echo $output;

