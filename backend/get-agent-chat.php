<?php

session_start();
include "../database/connection.php";
date_default_timezone_set('Africa/Lagos');
if(isset($_SESSION['id'])){ 
    $id = $_SESSION['id'];
}
$output = '';

$message = trim($_POST['message']);
$message = htmlspecialchars($message);
$message = stripslashes($message);

$incoming_id = $_POST['incoming_id'];

$outgoing_id =  $_POST['outgoing_id'];
$date_time = date('m/d/y h:i a', time());


$sql = "INSERT INTO chat (user_id, agent_id, message, time) VALUES(?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $incoming_id, $outgoing_id, $message, $date_time);
$stmt->execute();
   