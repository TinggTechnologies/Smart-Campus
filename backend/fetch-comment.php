<?php
session_start();
require "../database/connection.php";

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

$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

$sql = "SELECT * FROM comment WHERE post_id=? LIMIT 1";
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
            $formattedTime = formatPostTime($rows['timestamp']);

?>
<div class="comment-body d-flex-sb">
<div class="d-flex">
                <img style="width: 5rem; height: 5rem; border-radius: 50%;" src="uploads/<?= $rows1['image']; ?>">
                <div class="comments-dt" style="padding-left: 1rem;">
                    <h4 style="width: 15rem; margin-bottom: 0;"><?= $rows1['lastname'] . ' ' . $rows1['firstname']; ?> </h4><span class="comment-time"><?= $formattedTime; ?></span><br />
                    <span><?= $rows['comment']; ?></span>
                    <!--<span class="open-reply"><i>10 likes</i> <i class="bi bi-chat"> Reply</i></span> -->
                </div> 
            </div>
            </div>
<?php

} } else {
  echo "<div class='text-center text-danger'>no comment</div>";
}}



