<?php require "includes/dashboard-header.php"; ?>
<body>

    <section class="index-wrapper feeds-comments-header">
        <?php

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    
}

$sql = "SELECT * FROM post WHERE post_id=?";
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
              
            
                }
            }
          ?>
            <div class="single-post">
                
            </div>

            <div class="comments">
               
                </div>

                

            <div class="say-something chat-box">
                <div class="pp-in-ac">
                    <img src="<?= $row['image']; ?>">
                </div>
                <div class="write-something cb-ws">
                    <form id="comment_form">
                    <input type="text" class="form-control" id="comment" placeholder="Say something...">
                    <input type="hidden" id="post_id" value="<?= $rows['post_id']; ?>">
                    <input type="hidden" id="user_id" value="<?= $row['user_id']; ?>">
                    </form>
            
                </div>
                <div class="add-emoji cb">
                    <i class="bi bi-emoji-smile"></i>
                    <i class="bi bi-send cb-send" id="comment_btn" style="cursor: pointer;"></i>
                </div>
            </div>

           </form>
        </div>
            <?php
        }
    }
}

   ?> </section>

   <?php require "includes/dashboard-footer.php"; ?>

   <script>
    $(document).ready(function(){

        var comment = $('#comment').val();
        var post_id = $('#post_id').val();
        var user_id = $('#user_id').val();

        fetch_student_chat();

        setInterval(function(){
            fetch_student_chat();
            fetch_single_post();
        }, 1000);

        function fetch_single_post(){
            $.ajax({
                url: "backend/fetch-single-post.php",
                type: "POST",
                data:
                {
                    comment: comment,
                    post_id: post_id,
                    user_id:user_id
                },
                success:function(data){
                    $('.single-post').html(data);
                }
            });
        }

        function fetch_student_chat(){
            $.ajax({
                url: "backend/fetch-comment.php",
                type: "POST",
                data:
                {
                    comment: comment,
                    post_id: post_id,
                    user_id:user_id
                },
                success:function(data){
                    $('.comments').html(data);
                }
            });
        }

    $(document).on('click', '#comment_btn', function(e){
        e.preventDefault();

        var comment = $('#comment').val();
        var post_id = $('#post_id').val();
        var user_id = $('#user_id').val();

        if(comment == ""){
            Swal.fire(
            'Invalid',
            'Enter a comment',
            'error'
          )
            }
        else{
            $.ajax({
                url: 'backend/get-comment.php',
                type: 'post',
                data:
                {
                    comment: comment,
                    post_id: post_id,
                    user_id:user_id
                },
                success: function(data){
                    $('.comments').html(data);
                    
                }
            });
            $('#comment_form')[0].reset();
        }
    });

    setInterval( function(){

    $(document).on('click', '#like_btn', function(e){
        e.preventDefault();

        var post_id = $('#post_id').val();
        var user_id = $('#user_id').val();

            $.ajax({
                url: 'backend/insert-like.php',
                type: 'post',
                data:
                {
                    post_id: post_id,
                    user_id:user_id
                },
                success: function(data){

                    
                }
            });
            $('#like_form')[0].reset();
        
    });
}, 1000);

});                              
</script>

   
  