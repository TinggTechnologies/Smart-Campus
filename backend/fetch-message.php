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
  $count = "";
}
$output = ' <a href="messages.php">
<i class="bi bi-chat-text chats" style="font-size: 3rem;"></i>
<span class="badge bg-success badge-number" style="background-color: rgb(47, 47, 240); position: absolute; right: 6.5rem; top: 1.9rem; font-weight: bolder; padding: .5rem .5rem 1.7rem;">'. $count.'</span>
</a>' ;

        echo $output;

       

