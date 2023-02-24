<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM notification WHERE user_id=? AND unset != '1'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
if($count === 0){
  $count = "";
}
$output .= ' <a href="notification.php" style="position: relative;">
<i class="bi bi-bell"></i>
<span class="badge bg-success badge-number" style="background: rgb(47, 47, 240); position: absolute; right: -.8rem; top: -.7rem;">'. $count.'</span>
</a>

' ;

        echo $output;

       

