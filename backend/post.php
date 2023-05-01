<?php
session_start();
require_once "../database/connection.php";

    $text = trim($_POST["text"]);
    $text = stripslashes($text);
    $text = htmlspecialchars($text); 

    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
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
                $sql = "INSERT INTO post (post_image, user_id, text) VALUES(?,?,?)";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param('sss', $fileName, $id, $text);
                $stmt->execute();
            } else {
                echo "Failed to upload";
            }
        }
         
    }
     


   
