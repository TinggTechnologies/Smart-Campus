<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once "../database/connection.php";

if(isset($_POST["btn"])){

    $firstname = trim($_POST["firstname"]);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = trim($_POST["lastname"]); 
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $email = trim($_POST["email"]); 
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $project_topic = trim($_POST["project_topic"]); 
    $project_topic = stripslashes($project_topic);
    $project_topic = htmlspecialchars($project_topic);

    $project_desc = trim($_POST["project_desc"]); 
    $project_desc = stripslashes($project_desc);
    $project_desc = htmlspecialchars($project_desc);

    $group = trim($_POST["group"]); 
    $group = stripslashes($group);
    $group = htmlspecialchars($group);

    $supervisor_name = trim($_POST["supervisor_name"]); 
    $supervisor_name = stripslashes($supervisor_name);
    $supervisor_name = htmlspecialchars($supervisor_name);

    

    $sql = "INSERT INTO csc320(firstname, lastname, email, project_topic, project_description, project_group, supervisor_name) VALUES(?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $firstname, $lastname, $email, $project_topic, $project_desc, $group, $supervisor_name);
    if($stmt->execute()){
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
        
        $mail->Subject = "CSC 320.";
        $mail->Body = '<!doctype html>
        <html lang="en-US">
        
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>CSC 320</title>
            <meta name="description" content="CSC 320">
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
          welcome to Eazy Learn. we are really excited to have you to join our community! This email will help you get started. Please save it for your records</em><br>
         <br>
         <p>please feel free to reach us on the contact below if you have any questions or if there is anything else we can help with(09048480552).</p>
         <br>
                                               </p>
                                                
                 <a href="#" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> <span>We will get back to you concerning your Project</span></a>
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
    } else {
        echo "not registered";
    }


