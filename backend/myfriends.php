<?php
session_start();
include "../database/connection.php";
require "../backend/functions.php";

if(isset($_SESSION['id'])){
    $incoming_id = $_SESSION['id'];
}
$output = '';

// Fetch distinct friends and their latest messages
$sql = "SELECT m.*, u.user_id AS friend_id, u.lastname, u.firstname, u.image
        FROM users u
        LEFT JOIN (
            SELECT *, MAX(msg_id) AS max_msg_id
            FROM messages
            WHERE outgoing_id = ? OR incoming_id = ?
            GROUP BY CASE
                WHEN outgoing_id = ? THEN incoming_id
                WHEN incoming_id = ? THEN outgoing_id
            END
        ) latest_messages ON u.user_id = latest_messages.incoming_id OR u.user_id = latest_messages.outgoing_id
        LEFT JOIN messages m ON latest_messages.max_msg_id = m.msg_id
        WHERE (u.user_id = latest_messages.incoming_id OR u.user_id = latest_messages.outgoing_id) AND (u.user_id != ?)
        ORDER BY m.msg_id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $incoming_id, $incoming_id, $incoming_id, $incoming_id, $incoming_id);

if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $friend_id = $row['friend_id'];
            $outputs = $row['message'];
            $msg = (strlen($outputs) > 28) ? substr($outputs, 0, 28) . '....' : $outputs;

            $sql3 = "SELECT * FROM messages WHERE incoming_id=? AND outgoing_id=? AND alert != '1' ORDER BY msg_id DESC";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param('ss', $friend_id, $incoming_id);
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            $count3 = $result3->num_rows;

            if($count3 === 0){
                $count3 = "";
            }

            if($outputs == "No message available"){
                $timing = "";
            } else {
                $timing = substr($row['time'], 9); // Adjust the second parameter for the desired substring
            }

            if(is_user_online($friend_id)){
                $sta = "green";
            } else {
                $sta = "red";
            }

            $output .= '
            <a href="chat2.php?id='.$friend_id.'">
                <li class="individual-chat d-flex-sb">
                    <div class="d-flex">
                        <img src="uploads/'.$row['image'].'">
                        <div class="friend-chat" style="margin-left: .5rem;">
                            <h4>'.$row['lastname']. ' '.$row['firstname'].' <i class="bi bi-circle-fill" style="color: '.$sta.'; font-size: 1rem;"></i></h4>
                            <p class="read">'.$msg.'</p>
                        </div>
                    </div>
                    <div class="d-flex" style="flex-direction: column;">
                        <span>'.$timing.'</span> 
                        <span class="badge bg-success badge-number" style="background: blue; margin-left: 1rem; margin-top: 1rem;">'.$count3.'</span>
                    </div>
                </li>
            </a>';
        }
    } else {
        echo '<div class="text-center text-primary" style="font-weight: 700; font-size: 2.5rem;">No Message</div>';
    }
}
echo $output;
?>
