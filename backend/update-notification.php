<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){ 
    $id = $_SESSION['id'];
}
$output = '';

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
        $time = $row['time'];
        $formattedTime = formatPostTime($time);
        $sql2 = "SELECT * FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('s', $sender_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
        }
        $output .= '
        <a href="#"><li class="notification-row d-flex-sb">
       <img src="uploads/'.$row2['image'].'" />
        <div>
            <p>'.$row['message'].'</p>
            <small class="time">'.$time.'</small>
        </div>
        
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
   