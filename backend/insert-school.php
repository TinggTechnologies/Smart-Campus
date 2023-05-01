<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once "../database/connection.php";


    $school = $_POST["school"];
    $faculty = $_POST["faculty"];
    $department = $_POST["department"];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];

    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
    }

    $sql = "UPDATE users SET school=?, faculty=?, department=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $school, $faculty, $department, $id);
    if($stmt->execute()){
        $_SESSION['school'] = $school;
        $_SESSION['faculty'] = $faculty;
        $_SESSION['department'] = $department;

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.prestigehealthcare.com.ng';
        $mail->SMTPAuth = true;
        $mail->Username = "presti23";
        $mail->Password = "Joseph@21";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        
        $mail->From = "info@eazylearn.com.ng";
        $mail->FromName = "Eazy Learn Team";
        
        $mail->addAddress($email, $lastname . " " . $firstname);
        
        $mail->isHTML(true);
        
        $mail->Subject = "Welcome to Eazy Learn.";
        $mail->Body = '<!doctype html>
        <html lang="en-US">
        
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Verify Email Address</title>
            <meta name="description" content="Verify Email Address">
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
                                  <a href="https://eazylearn.com.ng/home" title="logo" target="_blank">
                                    <img width="100" src="https://www.eazylearn.com.ng/home/assets/img/easylearn/logo4.png" title="logo" alt="logo">
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
                                                   
                                                
         <h3>Hello '.$lastname.'!</h3><br>

         We are thrilled to welcome you to Eazy Learn, your one-stop shop for all your educational needs. Congratulations on taking the first step towards unlocking your full potential!. <br /><br />At Eazy Learn, we are committed to providing you with the best learning experience possible. Our platform is here to support you every step of the way.

          </em><br>
         <br>
         <p>please feel free to reach us on the contact below if you have any questions or if there is anything else we can help with(09048480552).</p>
         <br>
         Eazy Learn Team.
                                               </p>
                                                
                
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