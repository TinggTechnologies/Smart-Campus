<?php
session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $sender_id = $_SESSION['id'];
}

$receiver_id = $_POST['receiver_id'];
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $sender_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
$message = $row['lastname'] . ' ' . $row['firstname'] . ' just sent you a friends request';

// Use a prepared statement with parameter binding
$sql = "INSERT INTO friend_requests (user_id, friend_id, status) VALUES (?, ?, 'pending')";
$stmt2 = $conn->prepare($sql);
$stmt2->bind_param('ss', $sender_id, $receiver_id); // Assuming user_id and friend_id are integers

if($stmt2->execute()){
    $sql1 = "INSERT INTO notification (user_id, sender_id, message) VALUES (?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('sss', $receiver_id, $sender_id, $message);
    if($stmt1->execute()){
        echo "Request sent successfully.";
    }
   
} 
?>
