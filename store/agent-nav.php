<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "../database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
date_default_timezone_set('Africa/Lagos');
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}


$rm_sql = "SELECT * FROM users WHERE user_id=? AND (department='' OR school='' OR faculty='')";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    echo "<script>location.href = 'verify-email.php';</script>"; 
   }
}

$sql2 = "SELECT * FROM orders WHERE user_id=? AND payment_status='pending'";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('s', $id);
if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    $count_cart = $result2->num_rows;
    $background = '#00b1ff';
    $boxshadow = '0 2px 5px rgba(0, 0, 0, 0.3)';
    if($count_cart == 0){
        $count_cart = "";
        $background = "transparent";
        $boxshadow = '';
    } 
}

?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Smart Campus</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="../assets/img/easylearn/logo-cut.png">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>

   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/easylearn/logo-cut.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
   <style>
    .header-bottom .header-right .shopping-card::before {
  position: absolute;
  content: "<?= $count_cart;?>";
  width: 25px;
  height: 25px;
  background: <?= $background; ?>;
  color: #fff;
  line-height: 25px;
  text-align: center;
  border-radius: 30px;
  font-size: 12px;
  top: 0px;
  right: 10px;
  -webkit-transition: all 0.2s ease-out 0s;
  -moz-transition: all 0.2s ease-out 0s;
  -ms-transition: all 0.2s ease-out 0s;
  -o-transition: all 0.2s ease-out 0s;
  transition: all 0.2s ease-out 0s;
  box-shadow: <?= $boxshadow; ?>;
}
   </style>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
              
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="../dashboard.php"><img style="width: 4rem; height: 2rem; margin-top: 1rem;" src="../assets/img/easylearn/logo-cut.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                    
                                            <li><a href="download_pastquestion.php">Past Question</a></li>
                                            <li><a href="./download-tutorial.php">Tutorial</a></li>
                                            <li><a href="../room-mate-finder1.php">Room Mate</a></li>
                                            <li><a href="../store/">Market Place</a></li>
                                            <li><a href="../assignment-solver1.php">Assignment Solver</a></li>
                                            <li><a href="../house">Hostel</a></li>
                                            
                                                </ul>
                                            </li> 
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>