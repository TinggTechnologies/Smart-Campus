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
        $sender_id = $row['sender_id'];
        $sql2 = "SELECT * FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('s', $sender_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
        }
        $output .= '
        <a href="'.$row['link'].'"><li class="notification-row d-flex-sb">
        <img src="uploads/'.$row2['image'].'">
        <div>
            <p>'.$row['message'].'</p>
            <small class="time">'.$row['time'].'</small>
        </div>
        <span><i class="bi bi-three-dots"></i></span>
        </li></a>
        
        ' ;

    
}

} else {
    $output = '
    <section class="container-fluid login-wrapper pt-2">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6">
            <div class="login-form text-center">
      
            <h2 class="pt-5" style="font-size: 15rem; line-height: 1.3;"><i class="bi bi-bag-x-fill text-danger"></i></h2> 
            <span style="font-size: 1.8rem;" class="text-danger">No Notification</span>             
           
        </div>
            </div>
        </div>
       
    </div>
</section>
    
    ';
}

}
        echo $output;
   