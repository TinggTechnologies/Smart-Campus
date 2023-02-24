<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){ 
    $id = $_SESSION['id'];
}
$output = '';


$sql1 = "UPDATE notification SET unset='1' WHERE user_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('s', $id);
if($stmt1->execute()){

$sql = "SELECT * FROM notification WHERE user_id=? ORDER BY notification_id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $sql2 = "SELECT * FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('s', $id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
        }
        $output .= '
        <a href="#"><li class="notification-row d-flex-sb">
        <img src="uploads/'.$row2['image'].'">
        <div>
            <p>'.$row['message'].'</p>
            <small class="time">'.$row['time'].'</small>
        </div>
        <span><i class="bi bi-three-dots"></i></span>
        </li></a>
        
        ' ;

    
}

}}
        echo $output;
   