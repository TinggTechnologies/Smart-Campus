<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
    }
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
    <link href="./assets/img/easylearn/logo2.jpg" rel="icon">
    <link href="./assets/img/easylearn/logo2.jpg" rel="apple-touch-icon">

    <title>Easy Learn</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>

    <section class="friends-profile-wrapper">
        <nav class="top-nav bg-2 d-flex-sb">
            <a href="javascript:history.back();"><i class="bi bi-arrow-left"></i></a>
            <span><i class="bi bi-three-dots-vertical"></i></span>
        </nav>

        <div class="container-fluid friends-profile">
            
            <div class="person-info">
                <img src="<?= $rows['image'] ?>">
                <h3><?= $rows['lastname'] .' '.$rows['firstname']; ?></h3>
                <p style="font-weight: bolder; opacity: 1;"><?= $rows['school']; ?></p>
                <p style="color: blue;"><?= $rows['department']; ?> <span style="color: #030a23;">#<?= $rows['faculty']; ?></span></p>
            </div>
            <div class="more-info text-center d-flex-sb">
                <?php 
           $rm_sql = "SELECT * FROM friends WHERE user_id=? AND status='f'";
           $rm_stmt = $conn->prepare($rm_sql);
           $rm_stmt->bind_param('s', $user_id);
           if($rm_stmt->execute()){
              $rm_result = $rm_stmt->get_result();
              $count_friend = $rm_result->num_rows;
              }

              $rm_sql = "SELECT * FROM post WHERE user_id=?";
              $rm_stmt = $conn->prepare($rm_sql);
              $rm_stmt->bind_param('s', $user_id);
              if($rm_stmt->execute()){
                 $rm_result = $rm_stmt->get_result();
                 $count_post = $rm_result->num_rows;
                 }

                 $rm_sql = "SELECT * FROM past_question WHERE user_id=?";
                 $rm_stmt = $conn->prepare($rm_sql);
                 $rm_stmt->bind_param('s', $user_id);
                 if($rm_stmt->execute()){
                    $rm_result = $rm_stmt->get_result();
                    $count_point1 = $rm_result->num_rows * 5;
                    }
   
                 $rm_sql = "SELECT * FROM tutorial WHERE teacher_id=?";
                 $rm_stmt = $conn->prepare($rm_sql);
                 $rm_stmt->bind_param('s', $user_id);
                 if($rm_stmt->execute()){
                    $rm_result = $rm_stmt->get_result();
                    $count_point2 = $rm_result->num_rows * 5;
                    }
                    $total_point = $count_point1 + $count_point2;
                 ?>
                   <div>
                       <p><?= $count_friend; ?></p>
                       <h4>Friends</h4>
                   </div>
                   <div>
                       <p><?= $count_post; ?></p>
                       <h4>Posts</h4>
                   </div>
                   <div>
                       <p><?= $total_point; ?></p>
                       <h4>Point</h4>
                   </div>
               </div>
               <hr>
            <a href="edit-profile.php" class="form-control text-center" style="background-color: rgba(0,0,255,.6); color: #fff; border-radius: 25px;">Edit Profile</a>
          


    </section>

   <?php require "includes/dashboard-footer.php"; ?>
   