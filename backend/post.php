<?php

require_once "./database/connection.php";
$error = [];

if(isset($_POST["btn"])){
    $error = [];

    $text = trim($_POST["text"]);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);

    if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    } else {
        echo "no session";
    }
    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; 
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'png','jpeg', 'gif');
        if(in_array($fileActualExt, $allowed)){
            if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 2000000){
                $fileNameNew = time() . '.' . $fileActualExt;
                $fileDestination = 'uploads/'. $fileNameNew;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                    
                } else{
                    $error['file'] = "<div class='alert alert-danger'>Not moved</div>";
                }
            } else{
                $error['file'] = "<div class='alert alert-danger'>Your file is too long</div>";
            }}
            else{
                $error['file'] = "<div class='alert alert-danger'>An error occured</div>";
            }  }
            else{
                $error['file'] = "<div class='alert alert-danger'>you cannot upload files of this file</div>";
            }

            if(count($error) == 0){
                $sql = "INSERT INTO post (user_id,post_image,text) VALUES(?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sss', $id, $fileDestination, $text);
                    if($stmt->execute()){
                       echo "<script>location.href = 'dashboard.php';</script>";
                        
                    } else {
                        $error['file'] = "<div class='alert alert-danger'>An Error Occured</div>";
                    }
            } else {
                $error['file'] = "<div class='alert alert-danger'>An Error Occured</div>";
            }
         
        }    


   
    }
