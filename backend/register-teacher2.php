<?php
session_start();


require_once "../database/connection.php";


    $experience = $_POST["experience"];
    $office = $_POST["office"]; 
    $area = $_POST["area"]; 
    $department = $_POST["department"]; 
    $job = "Teacher";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
   
    

    $sql = "INSERT INTO register_teachers(teacher_id, department, job, experience, office, area, status) VALUES(?,?,?,?,?,?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $id, $department, $job,$experience, $office, $area);
    $stmt->execute();
       

