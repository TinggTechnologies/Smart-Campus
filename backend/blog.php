<?php

include "../database/connection.php";

$output = '';


$sql = "SELECT * FROM post ORDER BY post_id DESC";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['user_id'];
        $post_id = $rows['post_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $sql = "SELECT * FROM comment WHERE post_id='$post_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $get_result = $stmt->get_result();
                  $count_comment = $get_result->num_rows;
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
               
                $text = $rows['text'];
                (strlen($text) > 100) ? $msg = substr($text, 0, 100) . '.... <span class="text-primary">SEE MORE</span>' : $msg = $text;
        

    $output .= '
    <div class="feed-post">
  
        <a href="comments.php?post_id='.$rows['post_id'].'">
            <div class="feed-wrapper-img pt-5" id="image-container">
                <img id="my-image" src="uploads/'.$rows['post_image'] .'">
                <div id="loader"></div>
            </div>
            <p class="post-content">'.$msg.'</p>
        </a>
        <div class="post-details d-flex">
            <img src="uploads/'. $rows1['image'] .'">
            <h5 class="author-name" style="margin-left: 1rem;">
                <a href="#">'. $rows1['lastname'] . " " . $rows1['firstname'] .'</a>
            </h5>
            <span>
                  <form id="like_form" style="margin-left: 2.5rem;">
                <i class="bi '.$click_likes.' liked" style="margin-right: 10px; cursor:pointer;" id="like_btn"> '.$count_likes.'</i>
                    <i class="bi bi-chat"> '.$count_comment.'</i>
                </form>
            </span>
        </div>
    </div>';

}
    }
}
} else {
    $output .= "no post";
}
}
echo $output;


                