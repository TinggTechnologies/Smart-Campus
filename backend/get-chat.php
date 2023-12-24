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

// Handle file upload
$targetFilePath = ''; // Initialize the variable
if (!empty($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];

    // Move the uploaded file to the uploads directory
    $uploadDirectory = '../uploads/';
    $targetFilePath = $uploadDirectory . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        // File moved successfully
        // You may want to store $targetFilePath in the database or use it as needed
    } else {
        // File upload failed
        echo "Error uploading file.";
        exit();
    }
}


$sql = "INSERT INTO messages (incoming_id, outgoing_id, message, time, file_path) VALUES(?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $incoming_id, $outgoing_id, $message, $date_time, $targetFilePath);
$stmt->execute();
   