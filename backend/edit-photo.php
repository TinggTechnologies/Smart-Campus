<?php
include "./database/connection.php";

$error = array();
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
}

$sql2 = "SELECT * FROM users WHERE user_id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('s', $id);
if($stmt2->execute()){
    $result = $stmt2->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }
}

if(isset($_POST['image-btn'])){

    if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 2000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "UPDATE users SET image = '$fileDestination' WHERE user_id='$id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                $notification = $lastname . " " . $firstname . " just updated his photo";
                $sql1 = "INSERT INTO notification(user_id , message) VALUES('admin',?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('s', $notification);
                $stmt1->execute();
            
            echo "<script>location.href = 'image-upload-success.php';</script>";
            } }else{
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


