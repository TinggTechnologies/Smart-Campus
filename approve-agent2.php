<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Easy Learn</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/easylearn/logo4.png" rel="icon">
  <link href="assets/img/easylearn/logo4.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>
    <main id="main">
    <section id="pricing" class="pricing pt-0">
      <div class="container" data-aos="fade-up">

      <div class="section-header mt-2 d-flex justify-content-center align-items-center">
     <a href="javascript:history.back();">
     <i class="bi bi-arrow-left"></i>
          <a  href="#" style="font-size: 1.2rem; color: rgba(0,0,0,1); margin-left: .5rem;"> Approve Agent</a>
</a>

        </div>

<div class="fetch-room-mate">
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $output = '';
    
    
    $sql3 = "SELECT DISTINCT user_id,house_title,town,house_type,timestamp FROM register_house WHERE timestamp='$id'";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    if($result3->num_rows){
        while($row3 = $result3->fetch_assoc()){
            $time = $row3['timestamp'];
            $sql1 = "SELECT * FROM register_house WHERE timestamp='$time' ";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if($result1->num_rows){
                $row1 = $result1->fetch_assoc();
                $user_id = $row1['user_id'];
                $sql6 = "SELECT * FROM users WHERE user_id='$user_id' ";
                $stmt6 = $conn->prepare($sql6);
                $stmt6->execute();
                $result6 = $stmt6->get_result();
                if($result6->num_rows){
                    $row6 = $result6->fetch_assoc();
    
                }  
            }
    
    ?>
       <form id="business_form">
       <div class="row gy-4">
    
    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item message">
      <h3><?= $row6['lastname'] . " ".$row6['firstname']; ?></h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#<?= $row6['school'].' #'.$row3['town'].' #'.$row1['price'].' #'.$row1['house_type']; ?></h4>
        <section id="testimonials" class="testimonials">
        <input type="hidden" id="agent_id" value="<?= $time; ?>">
        <input type="hidden" id="user_id" value="<?= $user_id; ?>">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">
    <?php

$sql = "SELECT DISTINCT user_id,house_title,town,house_type,file,timestamp FROM register_house WHERE timestamp='$time' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
?>

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?= $row['file']; ?>" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      <?php
    }}
    ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <button name="btn" id="btn" class="buy-btn">Approve Agent</button>
       </form>
    
    </div>
    </section> 
    
          </div>
        </div><!-- End Pricing Item -->
    
        
      </div>

      <?php
    
    }
        }
    
    
    echo $output;
    ?>
  
</div>

      </div>
    </section><!-- End Pricing Section -->
    </main>
    <footer id="footer" class="footer">

</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="js/jquery2.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>


<script>
    $(document).ready(function(){

    $(document).on('click', '#btn', function(e){
        e.preventDefault();

        var btn = $('#btn').val();
        var user_id = $('#user_id').val();
        var agent_id = $('#agent_id').val();

        if(agent_id == ""){
            Swal.fire(
            'Invalid',
            'Enter a comment',
            'error'
          )
            }
        else{
            $.ajax({
                url: 'backend/approve-agent2.php',
                type: 'post',
                data:
                {
                    btn: btn,
                    user_id: user_id,
                    agent_id:agent_id
                },
                success: function(data){
                    $('.message').html(data);
                    location.href = 'admin-dashboard.php';
                }
            });
            $('#business_form')[0].reset();
        }
    });

   
});                              
</script>
