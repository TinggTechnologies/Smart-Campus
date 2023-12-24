<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM messages WHERE outgoing_id=? AND alert != '1'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
if($count === 0){
  $count = "transparent";
} else {
    $count = "#d9534f";
}
$output .= ' <a href="message-friends.php" class="notis">
<i class="bi bi-chat-text" style="color: rgba(0,0,0,1);"></i>
<small class="bell-notis notification-count" style="    background: '.$count.';"></small>
<span>Chat</span>
</a>

' ;

        echo $output;

       

