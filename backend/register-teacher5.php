<?php

$error = [];

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }

if(isset($_POST['btn'])){

if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 2000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "UPDATE register_teachers SET nin = ? WHERE teacher_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $fileDestination, $user_id);
            if($stmt->execute()){
                $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . ' just registered as a teacher';
                $sql1 = "INSERT INTO notification (user_id, message) VALUES('admin', ?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('s', $message);
                if($stmt1->execute()){

                echo "<script>location.href ='register-teacher4.php';</script>";
                }
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