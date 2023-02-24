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

$agent_id = $_POST['agent_id'];
$user_id = $_POST['user_id'];

            $sql = "DELETE FROM users WHERE user_id='$user_id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                echo "<script>location.href = 'admin-dashboard.php';</script>";
                } }
        



                    