<?php
session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
}

if($_FILES['file']['error'] > 0){
    echo 'Error: ' . $_FILES['file']['error'];
} else {
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileTemp = $_FILES['file']['tmp_name'];
    $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('img_') . '.' . $fileExt;
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . $fileName;
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    $maxSize = 5000000;
    if(!in_array($fileType, $allowedTypes)){
        echo "Invalid File Type";
    } else if($fileSize > $maxSize){
        echo "Image Size is too large";
    } else {
        if(move_uploaded_file($fileTemp, $uploadFile)){
            $sql = "UPDATE users SET image=? WHERE user_id='$id'";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param('s', $fileName);
            $stmt->execute();
        } else {
            echo "Failed to upload";
        }
    }
     
}


