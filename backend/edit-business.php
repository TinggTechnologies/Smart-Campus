<?php

$error = [];

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }

if(isset($_POST['btn'])){

    $business_name = $_POST['business_name'];
    $about = $_POST['about'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];

if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 2000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "UPDATE register_business SET business_name=?, about=?, state=?, city=?, address=?, postal_code=?, nin=?, user_id=?, status='pending' WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssssss', $business_name, $about, $state, $city, $address, $postal_code, $fileDestination, $user_id, $user_id);
            if($stmt->execute()){
                $message = "You have successfully updated your business, Easy Learn will have to re-verify your business profile";
                $sql1 = "INSERT INTO notification (user_id, message) VALUES(?,?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param('ss', $user_id, $message);
            if($stmt1->execute()){
                echo "<script>location.href ='business-edit-success.php';</script>";
            }}
           
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