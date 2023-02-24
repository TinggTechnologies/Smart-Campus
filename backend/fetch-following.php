<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM friends WHERE user_id=? AND status='p'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['friend_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $rows1 = $result1->fetch_assoc(); 
                }
            }
        

    $output .= '
    <li class="follower d-flex-sb">
    <a href="#">
        <div class="follower-img"><img src="'.$rows1['image'].'"></div>
        
        <div class="follower-info">
            <h4>'.$rows1['lastname']. ' ' . $rows1['firstname'].'</h4>
            <h5 style="font-weight: 500;">'.$rows1['school'].'</h5>
            <p>'.$rows1['department'].'</p>
        </div>
    </a>
    <div class="follow-btn"><button class="btn btn-gray">Pending</button></div>
</li>
';

}
    }
}
echo $output;

