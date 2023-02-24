<?php

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = "";


if(isset($_POST['pq-btn'])){
$department = $_POST['department'];
$course_title = $_POST['course_title'];
$ans = $_POST['ans'];

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
        if($_FILES['file']['size'] < 2000000000 ){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "INSERT INTO past_question (department, file, user_id, course_title, type, status) VALUES(?,?,?,?,?, 'pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssss', $department, $fileDestination, $id, $course_title, $ans);
            if($stmt->execute()){
            echo "<script>location.href = 'pq-success.php';</script>";
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
    