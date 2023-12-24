<?php

session_start();
include "../database/connection.php";
require "../backend/functions.php";

if(isset($_SESSION['id'])){
    $incoming_id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT DISTINCT user_id, agent_id FROM chat WHERE user_id='$incoming_id' ORDER BY chat_id desc";
$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
       while($fetch = $result->fetch_assoc()){
        $outgoing_id = $fetch['user_id'];
        $friend_id = $fetch['agent_id'];
        $sql2 = "SELECT * FROM users WHERE user_id='$friend_id'";
$stmt2 = $conn->prepare($sql2);

if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
       $fetch2 = $result2->fetch_assoc();
        $sql1 = "SELECT * FROM chat WHERE (user_id = '$friend_id' AND agent_id='$incoming_id') OR (user_id='$incoming_id' AND agent_id='$friend_id') ORDER BY chat_id DESC";
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

                $sql3 = "SELECT * FROM chat WHERE user_id='$friend_id' AND agent_id='$incoming_id' AND alert != '1' ORDER BY chat_id DESC";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $count3 = $result3->num_rows;
                if($count3 === 0){
                  $count3 = "";
                }

                if($outputs == "No message available"){
                  @$timing = "";
                } else {
                  @$timing = substr($row1['time'], 9, );
                }

                if(is_user_online($friend_id)){
                  $sta = "green";
                                  }else {
                                      $sta =  "red";
                                   }
          
                    
        $output .= '
        <a href="chat-agent.php?id='.$friend_id.'"><li class="individual-chat d-flex-sb">
       <div class="d-flex">
       <img src="uploads/'.$fetch2['image'].'">
       <div class="friend-chat" style="margin-left: .5rem;">
           <h4>'.$fetch2['lastname']. ' '.$fetch2['firstname'].' <i class="bi bi-circle-fill" style="color: '.$sta.'; font-size: 1rem;"></i></h4>
           <p class="read">'.$outputs.'</p>
       </div>
       </div>
        <div class="d-flex" style="flex-direction: column;">
        <span>'.@$timing.'</span> 
        <span class="badge bg-success badge-number" style="background: blue; margin-left: 1rem; margin-top: 1rem;">'.$count3.'</span>
        </div>
        </li></a>
        ';
      
   
}
}
} 
    
} else {
  echo '
  <div class="text-center text-primary" style="font-weight: 700; font-size: 2.5rem;">No Message</div>
  ';
}}
echo $output; 
