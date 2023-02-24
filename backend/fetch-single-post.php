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

$sql = "SELECT * FROM post WHERE post_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $post_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $uid = $rows['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $uid);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $rows1 = $result1->fetch_assoc(); 
                $sql = "SELECT * FROM comment WHERE post_id='$post_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $get_result = $stmt->get_result();
                  $count_comment = $get_result->num_rows;
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
                  $click_likes = "bi-heart-fill";
                } else {
                  $click_likes = "bi-heart";
                }
            
                }
            }
          
$output .= '
<header class="d-flex">
            <a href="javascript:history.back()"><i class="bi bi-chevron-left"></i></a>
            <div class="user-details-inheader d-flex">
                <img src="'. $rows1['image'].'">
                <div><a href="#">
                    <h4>'. $rows1['lastname'] . ' ' . $rows1['firstname'].'</h4>
                    <small>'. $rows1['date'].'</small>
                </a></div>
            </div>
            <i class="bi bi-three-dots notifications"></i>
        </header>

        <div class="comment-wrapper">

            <div class="authors-post">
                <div class="comment-image">
                    <img src="'. $rows['post_image'] .'">
                </div>
                <div class="post-contents">
                    '. $rows['text'].'
                </div>
            </div>
           <form id="comment_form">
          <form id="like_form">
          <div class="action-icons d-flex-sb">
                <span id="like_btn"><i class="bi '. $click_likes.' heart text-primary"> '. $count_likes.'</i></span>
                <span><i class="bi bi-chat"> '.$count_comment.'</i></span>
                <a href="friends-profile.php?user_id='.$uid.'"><i class="bi bi-person"></i></a>
                 
            </div>
          </form>
';

}
}
}
echo $output;