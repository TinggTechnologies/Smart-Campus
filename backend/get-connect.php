<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){ 
    $id = $_SESSION['id'];
}
$output = '';

$message = trim($_POST['message']);
$message = htmlspecialchars($message);
$message = stripslashes($message);

$incoming_id = $_POST['incoming_id'];

$outgoing_id =  $_POST['outgoing_id'];


$sql = "INSERT INTO connect (incoming_id, outgoing_id, message) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $incoming_id, $outgoing_id, $message);
$stmt->execute();
   