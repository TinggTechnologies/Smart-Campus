<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
include "../database/connection.php";



if(isset($_POST['btn'])){
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
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

            $sql = "UPDATE products SET status='approved' WHERE id='$teacher_id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                $message = "Your product has been approved by Smart Campus,  for students to make transaction.";
                $sql1 = "INSERT INTO  notification (user_id, sender_id, message) VALUES(?,'admin',?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('ss', $yid, $message);
                if($stmt1->execute()){
           
            }
           
} }
    



                