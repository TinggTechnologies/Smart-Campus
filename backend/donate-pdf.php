<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }


    $title = $_POST['title'];
    $desc = $_POST['desc'];

    if($_FILES['file']['error'] > 0){
        echo 'Error: ' . $_FILES['file']['error'];
    } else {
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileTemp = $_FILES['file']['tmp_name'];
        $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('doc_') . '.' . $fileExt;
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . $fileName;
        $allowedTypes = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint', 'application/vnd.oasis.opendocument.text,', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation');
        $maxSize = 5000000;
        if(!in_array($fileType, $allowedTypes)){
            echo "Invalid File Type";
        } else if($fileSize > $maxSize){
            echo "File Size is too large";
        } else {
            if(move_uploaded_file($fileTemp, $uploadFile)){
                $sql = "INSERT INTO tutorial (container, course_title, teacher_id, description, status, type) VALUES(?,?,?,?, 'pending', 'pdf')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssss', $fileName, $title, $user_id, $desc);
                $stmt->execute();
            } else {
                echo "Failed to upload";
            }
        }
         
    }



   