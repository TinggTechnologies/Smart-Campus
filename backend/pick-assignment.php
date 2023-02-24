<?php
session_start();

require_once "../database/connection.php";

    $price = $_POST["price"];
    $student_id = $_POST["student_id"];
    $teacher_id = $_POST["teacher_id"];
    $assignment_id = $_POST["assignment_id"];

    $sql = "INSERT INTO pick_assignment(assignment_id, student_id, teacher_id, price) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $assignment_id, $student_id, $teacher_id, $price);
    $stmt->execute();

