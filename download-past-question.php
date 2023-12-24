<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
//date_default_timezone_set('Africa/Lagos');
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

    <title>EazyLearn</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem; background-color: #fff;">

        <?php require_once "includes/pq-nav.php"; ?>
        <?php require "includes/footer-nav-no.php"; ?>

        <div>
        <p style="font-size: 1.7rem;">Download free exam past questions for all Nigerian Universities, Polytechnics, Colleges and Professional Institutions.</p>
        </div>

        <div class="search-wrapper" style="margin-top: 1rem; padding-bottom: 3rem;">
            <hr>
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="enter course title..." autocomplete="off" id="search" name="search">
                <i class="bi bi-search"></i>
            </div>
            <hr>
            <div class="search-result"></div>
            <?php
$output = '';
$depart = $row['department'];
$sql = "SELECT * FROM past_question WHERE department='$depart' AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
        $user_id = $row['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id='$user_id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
            $name = $row1['lastname'] . " " . $row1['firstname'];
            $department = $row1['department'];
        }
    ?>
     <style>
        /* Custom CSS for the background */
        .custom-bg {
            background: repeating-linear-gradient(45deg, rgba(0, 123, 255, 0.7), rgba(0, 123, 255, 0.7) 10px, rgba(0, 174, 255, 0.7) 10px, rgba(0, 174, 255, 0.7) 20px);
            padding: 20px;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <body>
    <section class="container-fluid login-wrapper pt-1">
        <div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-form custom-bg" style="border: 2px solid #ccc; padding: 20px; border-radius: 25px;">
                        <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;"><?=$row['course_title']?></h2>
                        <span style="font-weight: 500; font-size: 1.7rem;">Department: <?=$department?></span><br />
                        <span style="font-weight: 500; font-size: 1.7rem;">Institution: <?=$row1['school']?></span><br />
                        <span style="font-weight: 500; font-size: 1.7rem;">Price: &#x20A6;<?=$row['price']?></span><br />
                        <form id="profile_form">
                            <div class="form-group">
                                <a href="download-past-question2.php?pq_id=<?=$row['id']?>" i style="padding: 1rem 3rem;" class="getStarted-btn">Buy Now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
} 




     ?>
            ?>
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
      

       $("#search").keyup(function(){
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"backend/download-past-question.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data){
                    $(".search-result").html(data);
                }
            });

       }
    });
       
    });
   </script>