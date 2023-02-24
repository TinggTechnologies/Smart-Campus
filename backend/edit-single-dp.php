<?php

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = "";


if(isset($_POST['dp-btn'])){

$course_title = $_POST['course_title'];
$description = $_POST['description'];
$dp_id = $_POST['dp_id'];


    if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 2000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "UPDATE tutorial SET container=?, course_title=?, description=? WHERE tutorial_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $fileDestination, $course_title, $description, $dp_id);
            if($stmt->execute()){
            echo "<script>location.href = 'dp-edit-success.php';</script>";
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
    