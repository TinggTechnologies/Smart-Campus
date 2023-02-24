<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}


$rm_sql = "SELECT * FROM users WHERE user_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    $department = $rm_row['department'];
   }
}

if($department == ""){
    echo "<script>location.href = 'verify-email.php';</script>"; 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/easylearn/logo4.png" rel="icon">
    <link href="./assets/img/easylearn/logo4.png" rel="apple-touch-icon">

    <title>Eazy Learn</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>