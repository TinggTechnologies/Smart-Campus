<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $incoming_id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM connect WHERE incoming_id='$incoming_id' ORDER BY connect_id desc";
$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
       while($fetch = $result->fetch_assoc()){
        $friend_id = $fetch['outgoing_id'];
        $sql2 = "SELECT * FROM users WHERE user_id='$friend_id'";
$stmt2 = $conn->prepare($sql2);

if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
       $fetch2 = $result2->fetch_assoc();
        $sql1 = "SELECT * FROM connect WHERE (outgoing_id = '$friend_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$friend_id') ORDER BY connect_id DESC";
            $stmt1 = $conn->prepare($sql1);
            if($stmt1->execute()){
                $result1 = $stmt1->get_result();
                if($result1->num_rows > 0){
                    $row1 = $result1->fetch_assoc();
                      $outputs = $row1['message'];
                    } else {
                      $outputs = "No message available";
                    }
                }
                (strlen($output) > 28) ? $msg = substr($output, 0, 28) . '....' : $msg = $outputs;

                $sql3 = "SELECT * FROM connect WHERE incoming_id='$friend_id' AND outgoing_id='$incoming_id' AND alert != '1' ORDER BY connect_id DESC";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $count3 = $result3->num_rows;
                if($count3 === 0){
                  $count3 = "";
                  $check = "bi-check1-all";
                } else {
                    $check = "bi-check2-all";
                }
          
                    
        $output .= '
        <a href="connect.php?id='.$friend_id.'"><li class="individual-chat d-flex-sb">
        <img src="'.$fetch2['image'].'">
        <div class="friend-chat">
            <h4>'.$fetch2['lastname']. ' '.$fetch2['firstname'].'</h4>
            <p class="read">'.$outputs.'</p>
        </div>
        <span><i class="bi '.$check.' read"></i></span>
        <span class="badge bg-success badge-number" style="background:rgb(214, 78, 101);">'.$count3.'</span>
        </li></a>
        ';
      
   
}
}
}
    
}}
echo $output; 
