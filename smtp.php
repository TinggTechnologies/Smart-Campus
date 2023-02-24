<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'mail.prestigehealthcare.com.ng';
$mail->SMTPAuth = true;
$mail->Username = "presti23";
$mail->Password = "Joseph@21";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

$mail->From = "info@eazylearn.com.ng";
$mail->FromName = "Full Name";

$mail->addAddress("ndunchej@gmail.com", "recipient name");

$mail->isHTML(true);

$mail->Subject = "Mail sent from php send mail script.";
$mail->Body = "<i>Text content from send mail.</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>