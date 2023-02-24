<?php
$error = [];
include "./database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = "";


if(isset($_POST['assignment-btn'])){
$department = $_POST['department'];
$course_title = $_POST['course_title'];
$description = $_POST['description'];
$no_of_pages = $_POST['no_of_pages'];
$deadline = $_POST['submission_date'];
$ass_code = rand(111111, 666666);

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
            $sql = "INSERT INTO assigment (assignment_code, department, assignment_file, student_id, no_of_pages, course_description, course_title, deadline, status) VALUES(?,?,?,?,?,?,?,?, 'pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssss', $ass_code, $department, $fileDestination, $id, $no_of_pages, $description, $course_title, $deadline);
            if($stmt->execute()){
                $_SESSION['ass_code'] = $ass_code;
            echo "<script>location.href = 'assignment-success.php';</script>";
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
    