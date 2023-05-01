<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}


if(isset($_POST['btn'])){

$teacher_id = $_POST['teacher_id'];
$yid = $_POST['yid'];

$sql2 = "SELECT * FROM users WHERE user_id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('s', $yid);
if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
        $row2 = $result2->fetch_assoc();
        $lastname = $row2['lastname'];
        $firstname = $row2['firstname'];
        $email = $row2['email'];
    }}

            $sql = "UPDATE register_business SET status='active' WHERE id='$yid'";
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
    



                