<?php

include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}


if(isset($_POST['btn'])){

$teacher_id = $_POST['teacher_id'];
$yid = $_POST['yid'];

            $sql = "UPDATE register_business SET status='active' WHERE id='$teacher_id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                $message = "Your Business has been approved by Eazy Learn, you can start uploading your business for students to make transaction.";
                $sql1 = "INSERT INTO  notification (user_id, message) VALUES(?,?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('ss', $yid, $message);
                if($stmt1->execute()){
            echo "<script>location.href = 'admin-dashboard.php';</script>";
            }
           
} }
    



                