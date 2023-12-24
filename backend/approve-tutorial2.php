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

$sql6 = "SELECT * FROM users WHERE user_id='$user_id' ";
            $stmt6 = $conn->prepare($sql6);
            $stmt6->execute();
            $result6 = $stmt6->get_result();
            if($result6->num_rows > 0){
                $row6 = $result6->fetch_assoc();
                $email = $row6['email'];
              }

            $sql = "UPDATE tutorial SET status='active' WHERE tutorial_id='$agent_id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'mail.smartcampus.com.ng';
                $mail->SMTPAuth = true;
                $mail->Username = "info@smartcampus.com.ng";
                $mail->Password = "Chizaram@21";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;

                $mail->From = "info@Smart Campus.com.ng";
                $mail->FromName = "Smart Campus";

                $mail->addAddress($email, "Smart Campus");

                $mail->isHTML(true);

                $mail->Subject = "Tutorial Approval.";
                $mail->Body = '<!doctype html>
                <html lang="en-US">

                <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Tutorial Approval</title>
                    <meta name="description" content="Tutorial Approval">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;}
                    </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                    <!--100% body table-->
                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                        <tr>
                            <td>
                                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                    align="center" cellpadding="0" cellspacing="0">
                                    <br>
                                    <tr>
                                        <td style="text-align:center;">
                                        <a href="https://smartcampus.com.ng" title="logo" target="_blank">
                                            <img width="100" src="https://www.smartcampus.com.ng/assets/img/easylearn/logo-cut.png" title="logo" alt="logo">
                                        </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 35px;">
                                                        
                                                        
                <h3>Hello!</h3><br>
                We are really excited to have you to join our community! This email will help you get started. Please save it for your records</em><br>
                <br>
                <p>please feel free to reach us on the contact below if you have any questions or if there is anything else we can help with(09048480552).</p>
                <br>
                                                    </p>
                                                        
                        <a href="https://smartcampus.com.ng" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> <span>Your Tutorial has been approved by Smart Campus.</span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                    <td style="text-align:center;">
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong><span></span></strong></p>
                                        </td>
                                    </tr>
                                    <br>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--/100% body table-->
                </body>

                </html>';
                $mail->AltBody = "";
                if($mail->send()){
                    $sql = "SELECT * FROM users";
                    $stmt = $conn->prepare($sql);
                    if($stmt->execute()){
                        $result = $stmt->get_result();
                        if($result->num_rows > 0){
                            while($rows = $result->fetch_assoc()){
                            $mail = new PHPMailer(true);
                            $mail->SMTPDebug = 0;
                            $mail->isSMTP();
                            $mail->Host = 'mail.smartcampus.com.ng';
                            $mail->SMTPAuth = true;
                            $mail->Username = "info@smartcampus.com.ng";
                            $mail->Password = "Chizaram@21";
                            $mail->SMTPSecure = "ssl";
                            $mail->Port = 465;
            
                            $mail->From = "info@Smart Campus.com.ng";
                            $mail->FromName = "Smart Campus";
            
                            $mail->addAddress($rows['email'], "Smart Campus");
            
                            $mail->isHTML(true);
            
                            $mail->Subject = "New Note added.";
                            $mail->Body = '<!doctype html>
                            <html lang="en-US">
            
                            <head>
                                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                                <title>New Note Added</title>
                                <meta name="description" content="New Note Added">
                                <style type="text/css">
                                    a:hover {text-decoration: underline !important;}
                                </style>
                            </head>
            
                            <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                                <!--100% body table-->
                                <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                                    style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                                    <tr>
                                        <td>
                                            <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                                align="center" cellpadding="0" cellspacing="0">
                                                <br>
                                                <tr>
                                                    <td style="text-align:center;">
                                                    <a href="https://smartcampus.com.ng" title="logo" target="_blank">
                                                        <img width="100" src="https://www.smartcampus.com.ng/assets/img/easylearn/logo-cut.png" title="logo" alt="logo">
                                                    </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:20px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                            style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                            <tr>
                                                                <td style="height:40px;">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0 35px;">
                                                                    
                                                                    
                            <h3>Hello!</h3><br>
                            A New tutorial note has been added to Smart Campus. You can login and check it out</em><a href="https://smartcampus.com.ng">Login to Smart Campus</a><br>
                            <br>
                            <p>please feel free to reach us on the contact below if you have any questions or if there is anything else we can help with(09048480552).</p>
                            <br>
                                                                </p>
                                                                    
                                    <a href="https://smartcampus.com.ng" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> <span>Your Tutorial has been approved by Smart Campus.</span></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height:40px;">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                <tr>
                                                    <td style="height:20px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                <td style="text-align:center;">
                                                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong><span></span></strong></p>
                                                    </td>
                                                </tr>
                                                <br>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--/100% body table-->
                            </body>
            
                            </html>';
                            $mail->AltBody = "";
                            $mail->send();
                        }
                    }
                            }
                        
                } }}
        



                    