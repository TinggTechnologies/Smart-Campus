<?php

$error = [];

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }

if(isset($_POST['donate-pdf-btn'])){

    $title = $_POST['title'];
    $desc = $_POST['desc'];

if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 2000000000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "INSERT INTO tutorial (container, course_title, teacher_id, description, status, type) VALUES(?,?,?,?, 'pending', 'pdf')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $fileDestination, $title, $user_id, $desc);
            if($stmt->execute()){
                echo "<script>location.href ='donate-pdf-success.php';</script>";
            }
           
            } else{
                $error['file'] = "<div class='alert alert-danger'>Not moved</div>";
            }
        } else{
            $error['file'] = "<div class='alert alert-danger'>The file is too long</div>";
        }}
        else{
            $error['file'] = "<div class='alert alert-danger'>An error occured</div>";
        }  }
        else{
            $error['file'] = "<div class='alert alert-danger'>you cannot upload files of this file</div>";
        }
    

    
    }
}