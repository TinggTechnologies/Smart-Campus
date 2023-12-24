<?php
session_start();
include "../database/connection.php";
//date_default_timezone_set('Africa/Lagos');
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
?>
<style>
    /* Styles for the 'bi-heart-fill' class (red heart) */
    .bi-heart-fill {
        color: red; /* Make the heart icon red */
    }

    /* Styles for the 'bi-heart' class (transparent heart) */
    .bi-heart {
         color: black; /* Make the heart icon transparent */
    }
    .loader {
    display: block;
    width: 50px; /* Customize the width and height as needed */
    height: 50px;
    margin: 0 auto;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
video {
    pointer-events: none;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
<?php

$output = '';

$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}

function formatPostTime($postTime, $timezone = 'Africa/Lagos') {
    // Create DateTime objects for the current time and the post time
    $currentTime = new DateTime('now', new DateTimeZone($timezone));
    $postTime = new DateTime($postTime, new DateTimeZone($timezone));

    // Calculate the difference in time
    $interval = $postTime->diff($currentTime);

    // Define singular and plural units for each time interval
    $units = [
        'y' => ['year', 'years'],
        'm' => ['month', 'months'],
        'd' => ['day', 'days'],
        'h' => ['hour', 'hours'],
        'i' => ['minute', 'minutes'],
        's' => ['second', 'seconds']
    ];

    // Check each unit and return the appropriate representation
    foreach ($units as $key => $unit) {
        if ($interval->$key > 0) {
            $unitStr = ($interval->$key === 1) ? $unit[0] : $unit[1];
            return $interval->$key . ' ' . $unitStr . ' ago';
        }
    }

    return 'just now';
}




$sql = "SELECT * FROM post ORDER BY RAND() LIMIT 10";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['user_id'];
        $post_id = $rows['post_id'];
        $dislike_count = $rows['dislike_count'];
        
        $postTime = $rows['post_date']; 
        $formattedTime = formatPostTime($postTime);
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
               
                    $sql3 = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$id'";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->execute();
                    $likes_result3 = $stmt3->get_result();
                    if($likes_result3->num_rows > 0){
                        $heart = "bi-heart-fill text-danger";
                    } else {
                        $heart = "bi-heart";
                    }
                
             
                
               
        $text = $rows['text'];
        (strlen($text) > 100) ? $msg = substr($text, 0, 100) . '.... <span class="text-primary">SEE MORE</span>' : $msg = $text;

?>
    
    <div class="feed-post">
                <div class="feed-post-author-details d-flex-sb">
                    <div class="fpad-box d-flex">
                        <a href="friends-profile2.php?user_id=<?= $rows1['user_id']; ?>" class="d-flex-sb">
                        
                            <img src="uploads/<?php echo $rows1['image']; ?>" />
                         
                            <div class="fpad-author-name">
                                <h4><?= $rows1['lastname'] . " " . $rows1['firstname']; ?></h4>
                                <small><?= $formattedTime; ?> <i class="bi bi-hourglass-split"></i></small>
                            </div>
                        </a>
                    </div>
                    <i class="bi bi-three-dots open-expand-action-box"></i>
                    <div class="expand-action-box">
                        <div class="top">
                            <i class="bi bi-x close-expand-action-box"></i>
                        </div>
                        <ul>
                        <li><a href="./chat2.php?id=<?= $user_id; ?>"><i class="bi bi-chat-fill"></i> Chat User</a></li>
                            <li><a href="./friends-profile2.php?user_id=<?= $user_id; ?>"><i class="bi bi-eye-fill"></i> View Profile</a></li>
                            <li><a href="./friends.php"><i class="bi bi-person-fill"></i> Add friend</a></li>
                         <!--   <li><a href="#"><i class="bi bi-x-square-fill"></i> Hide post</a></li>
                            <li><a href="#"><i class="bi bi-person-dash-fill"></i> Unfriend Joseph</a></li>
                            <li><a href="#"><i class="bi bi-person-dash-fill"></i> Block Joseph</a></li> -->
                            <li><a href="./chat2.php?id=admin"><i class="bi bi-exclamation-circle-fill"></i> Report post</a></li>
                        </ul>
                    </div>
                </div>
                <p class="post-content"><?= $msg; ?></p>
                
                <div class="feed-post-img">
                <?php
    $postImage = $rows['post_image'];
    $fileExtension = pathinfo("uploads/$postImage", PATHINFO_EXTENSION);

    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
        // Display an image
        echo '<div class="image-container">';
        echo '<div class="loader"></div>';
        echo "<img src='uploads/$postImage' onload=\"this.parentNode.querySelector('.loader').style.display='none'\">";
        echo '</div>';
    } elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'mov'])) {
        // Display a video
        echo '<video controls style="height: 27rem; width: 100%;">';
        echo "<source src='uploads/$postImage' type='video/$fileExtension'>";
        echo '</video>';
    }
    ?>
                </div>
                
                <div class="post-details d-flex-sb">
                    <span>
                    <i class="bi <?= $heart; ?>" onclick="toggleLike(<?= $rows['post_id']; ?>);" id="like_loop_<?= $rows['post_id']; ?>">
                    <span id="like_count_<?= $rows['post_id']; ?>"><?= $count_likes; ?></span>
                </i>
                


                        <i class="bi bi-chat-square-text open-comment" data-post-id="<?= $post_id; ?>"> <?= $count_comment; ?></i>

                        
                        <!-- Open comment box -->
<div class="comments-box">
    <div class="comment-top d-flex-sb">
        <h4 class="text-center">Comments</h4>
        <i class="bi bi-x close-comment"></i>
    </div>
  
    <!-- Comment input -->
    <form id="comment_form" data-post-id="<?= $post_id; ?>">
    <div class="comment-wrapper">
        
        </div>
    <div class="type-comment d-flex">
        <div class="reply-comment-pp">
            <img src="uploads/<?= $row['image']; ?> ">
        </div>
                    <input type="hidden" id="user_id" value="<?= $row['user_id']; ?>">
        <div class="write-something">
            <input type="text" id="comment" class="form-control" placeholder="Say something <?= $row['lastname']; ?>...">
        </div>
        
        <div class="action-icon get-comment">
            <i class="bi bi-pencil comment_btn" ></i> <!-- Changed the icon to represent opening comments -->
        </div>
    </div>
    </form>
</div>


                    </span>
                 <!--   <i class="bi bi-eye"> 0</i> -->
                </div>
            </div>

  
    <?php

}
    }
}
} else {
    ?>
    <div class='text-danger text-center'>no post</div>
    <?php
}
}

?>

<script>

function toggleLike(postId) {
    const likeButton = document.getElementById('like_loop_' + postId);
    const likeCount = document.getElementById('like_count_' + postId);

    const isLiked = likeButton.classList.contains('bi-heart-fill');
    const count_likes = parseInt(likeCount.textContent);

    $.ajax({
        url: 'backend/like.php',
        type: 'post',
        data: {
            post_id: postId,
            like_status: (isLiked ? 'unlike' : 'like')
        },
        success: function(response) {
            console.log('Like updated successfully: ' + response);
            likeCount.textContent = response;

            if (response > count_likes) {
                likeButton.classList.remove('bi-heart');
                likeButton.classList.add('bi-heart-fill');
            } else {
                likeButton.classList.remove('bi-heart-fill');
                likeButton.classList.add('bi-heart');
            }
        },
        error: function(xhr, textStatus, error) {
            console.log('Error updating like: ' + xhr.statusText);
        }
    });
}


</script>



    <script>
        
    // Handling opening and close feed post expand action box
    let openExpandActionList = document.querySelectorAll('.open-expand-action-box');
let closeExpandActionList = document.querySelectorAll('.close-expand-action-box');

openExpandActionList.forEach((openExpandAction, index) => {
    let expandActionBox = openExpandAction.nextElementSibling;

    openExpandAction.onclick = () => {
        expandActionBox.classList.add('active');
    }

    closeExpandActionList[index].onclick = () => {
        expandActionBox.classList.remove('active');
    }
});

 


   // Get all elements with the class 'open-comment'
const openCommentButtons = document.querySelectorAll('.open-comment');

// Iterate through each open comment button
openCommentButtons.forEach((openCommentButton, index) => {
    openCommentButton.onclick = () => {
        // Get the corresponding comment box for the clicked button
        const commentBox = document.querySelectorAll('.comments-box')[index];
        commentBox.classList.add('active');
    }
});

// Get all elements with the class 'close-comment'
const closeCommentButtons = document.querySelectorAll('.close-comment');

// Iterate through each close comment button
closeCommentButtons.forEach((closeCommentButton, index) => {
    closeCommentButton.onclick = () => {
        // Get the corresponding comment box for the clicked button
        const commentBox = document.querySelectorAll('.comments-box')[index];
        commentBox.classList.remove('active');
    }
});






    </script>

<script>       
    $(document).ready(function(){

        $('.menu-toggle .clickme').click(function() {
            $(this).toggleClass('active');
            $('.menu-links').toggleClass('active');
        });

        fetch_user();

        setInterval(function(){
            fetch_user();
            fetch_status();
        }, 5000);

        setInterval(function(){
            fetch_notification();
            fetch_friends_request();
        }, 1000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-message.php",
                method: "POST",
                success: function(data){
                    $(".mes").html(data);
                }
            });
        }

        function fetch_notification(){
            $.ajax({
                url:"backend/fetch-notification.php",
                method: "POST",
                success: function(data){
                    $(".not").html(data);
                }
            });
        }

        function fetch_friends_request(){
            $.ajax({
                url:"backend/fetch-fr.php",
                method: "POST",
                success: function(data){
                    $(".people").html(data);
                }
            });
        }

        function fetch_status(){
            $.ajax({
                url:"backend/update-last-activity.php",
                method: "POST",
                success: function(data){
                    $(".status").html(data);
                }
            });
        }

  $('.post').on('click', function() {
    $(this).find('i').removeClass('fa-plus');
    $(this).find('i').addClass('fa-times');
    $(this).find('i').css('background-color', '#dc3545');
    $(this).find('i').css('box-shadow', '0px 5px 6px rgba(0, 0, 0, 0.1)');
    $(this).find('i').animate({
      width: '80px',
      height: '80px',
      borderRadius: '50%',
      bottom: '10px'
    }); 

});

 
    });


   </script>

<script>
  
  $(document).ready(function () {
  var currentPostId = null;
  var comment = '';
  var debounceTimeout;

  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('open-comment')) {
      var post_id = event.target.getAttribute('data-post-id');

      if (currentPostId !== post_id) {
        currentPostId = post_id;
        comment = '';
      }

      // Update comment on input change, but with a delay (e.g., 500 milliseconds)
      clearTimeout(debounceTimeout);
      debounceTimeout = setTimeout(function () {
        comment = $('#comment').val();
        fetchStudentChat(post_id, comment);
      }, 500);
    }
  });

  function fetchStudentChat(post_id, comment) {
    $.ajax({
      url: "backend/fetch-comment.php",
      type: "POST",
      data: {
        comment: comment,
        post_id: post_id,
        user_id: $('#user_id').val()
      },
      cache: false,
      success: function (data) {
        $('.comment-wrapper').html(data);
      }
    });
  }

  setInterval(function () {
    if (currentPostId !== null) {
      fetchStudentChat(currentPostId, comment);
    }
  }, 2000);
});


       
$(document).ready(function() {
    $('.comment_btn').click(function(event) {
        event.preventDefault();

        // Retrieve post_id from the data attribute of the parent form
        var post_id = $(this).closest('form').data('post-id');

        // Retrieve comment from the input field within the parent form
        var comment = $(this).closest('form').find('#comment').val();

        // Retrieve user_id from the hidden input field
        var user_id = $('#user_id').val();

        console.log('post_id:', post_id);
        console.log('comment:', comment);
        console.log('user_id:', user_id);

        // Rest of your AJAX code
        $.ajax({
            url: 'backend/get-comment.php',
            type: 'post',
            data: {
                comment: comment,
                post_id: post_id,
                user_id: user_id
            },
            cache: false,
            success: function(data) {
                // Update the comment wrapper with the new comment
                $('.comment-wrapper').html(data);
            }
        });

        // Reset the form after submission
        $(this).closest('form')[0].reset();
    });
});


</script>



                