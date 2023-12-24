<?php

session_start();
include "../database/connection.php";
require "../backend/functions.php";

if(isset($_SESSION['id'])){
    $incoming_id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT u.user_id,  u.image, u.lastname, u.firstname, m.outgoing_id, m.incoming_id, m.message
FROM users u
INNER JOIN messages m
ON u.user_id = IF(m.outgoing_id='$incoming_id', m.incoming_id, m.outgoing_id)
WHERE (m.outgoing_id='$incoming_id' OR m.incoming_id='$incoming_id')
AND u.user_id != '$incoming_id'
GROUP BY u.user_id
ORDER BY m.timestamp DESC

";
$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
       while($fetch = $result->fetch_assoc()){
        $outgoing_id = $fetch['outgoing_id'];
        $friend_id = $fetch['incoming_id'];

        $sql1 = "SELECT * FROM messages WHERE (outgoing_id = '$friend_id' AND incoming_id='$outgoing_id') OR (outgoing_id='$outgoing_id' AND incoming_id='$friend_id') ORDER BY msg_id DESC";
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

                $sql3 = "SELECT * FROM messages WHERE incoming_id='$friend_id' AND outgoing_id='$incoming_id' AND alert != '1'";
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
                  @$timing = substr($row1['time'], 8, );
                }


                if(is_user_online($friend_id)){
                  $sta = "green";
                                  }else {
                                      $sta =  "red";
                                   }
          
                    
        $output .= '
        <a href="chat2.php?id='.$fetch['user_id'].'"><li class="individual-chat d-flex-sb">
       <div class="d-flex">
       <img src="uploads/'.$fetch['image'].'">
       <div class="friend-chat" style="margin-left: .5rem;">
           <h4>'.$fetch['lastname']. ' '.$fetch['firstname'].' <i class="bi bi-circle-fill" style="color: '.$sta.'; font-size: 1rem;"></i></h4>
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
else {
  echo '
  <div class="text-center text-primary" style="font-weight: 700; font-size: 2.5rem;">No Friends</div>
  ';
}
} 
    

echo $output; 
