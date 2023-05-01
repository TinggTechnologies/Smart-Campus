<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM friends WHERE friend_id=? and status='p'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
if($count === 0){
  $count = "";
}
$output .= ' <a href="followers.php" style="position: relative;">
<i class="bi bi-people"></i>
<span class="badge bg-success badge-number" style="background: rgb(47, 47, 240); position: absolute; right: -.3rem; top: -.2rem;">'. $count.'</span>
</a>

' ;

        echo $output;

       

