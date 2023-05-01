<?php
session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = "";


$department = $_POST['department'];
$course_title = $_POST['course_title'];
$description = $_POST['description'];
$no_of_pages = $_POST['no_of_pages'];
$deadline = $_POST['submission_date'];
        
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
                $sql = "INSERT INTO assigment (department, assignment_file, student_id, no_of_pages, course_description, course_title, deadline, status) VALUES(?,?,?,?,?,?,?, 'pending')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssss', $department, $fileName, $id, $no_of_pages, $description, $course_title, $deadline);
                $stmt->execute();
            } else {
                echo "Failed to upload";
            }
        }
         
    }

    