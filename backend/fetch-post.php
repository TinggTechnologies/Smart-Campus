<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';


$sql = "SELECT * FROM post ORDER BY RAND() LIMIT 10";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['user_id'];
        $post_id = $rows['post_id'];
        $like_count = $rows['like_count'];
        $dislike_count = $rows['dislike_count'];
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
                $sql4 = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$id'";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->execute();
                $likes_result4 = $stmt4->get_result();
                if($likes_result4->num_rows > 0){
                  $click_likes = "bi bi-heart-fill";
                  $like_color = "blue";
                } else {
                  $click_likes = "bi bi-heart";
                  $like_color = "black";
                }
               
        $text = $rows['text'];
        (strlen($text) > 100) ? $msg = substr($text, 0, 100) . '.... <span class="text-primary">SEE MORE</span>' : $msg = $text;

    $output .= '
    <div class="feed-post">
    <div style="padding: 1rem"><div class="post-details d-flex" style="align-items: center; justify-content: space-between; width: 100%; margin: auto;">
    <img src="uploads/'. $rows1['image'] .'">
    <h5 class="author-name" style="margin-right: 8rem;">
        <a href="#">'. $rows1['lastname'] . " " . $rows1['firstname'] .'</a>
    </h5>
    <span>
   
            <i class="bi bi-grip-horizontal" style="cursor: pointer; font-size: 25px;"></i>
        
    
    </span>
</div>
</div>
    <a href="comments.php?post_id='.$rows['post_id'].'">
    
        <div class="feed-wrapper-img">
            <img src="uploads/'.$rows['post_image'] .'">
        </div>
        <p class="post-content" style="width: 95%; margin: auto; padding: 1rem 0;">'.$msg.'</p>    
    </a>
    <div class="post-details d-flex" style="align-items: center; justify-content: space-between; width: 90%; margin: auto; padding: 1rem 0">
       
            <i class="bi bi-heart liked" style="cursor: pointer; font-size: 18px; padding: 1rem 3rem;"  onclick="like_update('.$rows['post_id'].');" id="like_loop_'.$rows['post_id'].'"> '.$like_count.'</i>
            <a href="comments.php?post_id='.$rows['post_id'].'">
                <i class="bi bi-chat" style="cursor: pointer; font-size: 18px; padding: 1rem 3rem;"> '.$count_comment.'</i>
            </a>
            <a href="comments.php?post_id='.$rows['post_id'].'">
            <i class="bi bi-send" style="cursor: pointer; font-size: 18px; padding: 1rem 3rem;"></i>
        </a>
          
    </div>
</div>
  
    ';

}
    }
}
} else {
    $output .= "no post";
}
}
echo $output;
?>


<script>

function like_update(id){
            var cur_count = jQuery('#like_loop_'+id).html();
            cur_count++;
            jQuery('#like_loop_'+id).html(cur_count);
            $.ajax({
                url: 'backend/like.php',
                type: 'post',
                data:
                {
                    post_id: id, 
                },
                success: function(response){
                    
                    $('#message').html(response);
                    
            }
            });

            $('#like_form')[0].reset();
        }

        function dislike_update(id){
            var cur_count = jQuery('#dislike_loop_'+id).html();
            cur_count++;
            jQuery('#dislike_loop_'+id).html(cur_count);
            $.ajax({
                url: 'backend/dislike.php',
                type: 'post',
                data:
                {
                    post_id: id, 
                },
                success: function(response){
                    
                    $('#message').html(response);
                    
            }
            });

            $('#like_form')[0].reset();
        }

</script>
                