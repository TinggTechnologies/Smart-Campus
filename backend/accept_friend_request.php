<?php
session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $sender_id = $_SESSION['id'];
}

$receiver_id = $_POST['receiver_id'];

// Use a prepared statement with parameter binding
$sql = "UPDATE friend_requests SET status='accepted' WHERE friend_id=? AND user_id=?";
$stmt2 = $conn->prepare($sql);
$stmt2->bind_param('ss', $sender_id, $receiver_id); // Assuming user_id and friend_id are integers

if($stmt2->execute()){
    echo "Request accepted successfully.";
} else {
    echo "Error: " . $conn->error;
}
?>
