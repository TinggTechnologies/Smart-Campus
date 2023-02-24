<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "backend/approve-teacher2.php";
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
  <link href="assets/img/easylearn/logo4.jpg" rel="icon">
  <link href="assets/img/easylearn/logo4.jpg" rel="apple-touch-icon">

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
          <a  href="#" style="font-size: 1.2rem; color: rgba(0,0,0,1); margin-left: .5rem;"> Approve Teacher</a>
</a>

        </div>

<div class="fetch-room-mate">
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $output = '';
    
    
    $sql2 = "SELECT * FROM register_teachers WHERE id=?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('s', $id);
    if($stmt2->execute()){
        $result2 = $stmt2->get_result();
        if($result2->num_rows > 0){
            $rowss = $result2->fetch_assoc();
                $sql3 = "SELECT * FROM users WHERE user_id=?";
                $stmt3 = $conn->prepare($sql3);
                $yid = $rowss['teacher_id'];
                $stmt3->bind_param('s', $yid);
                if($stmt3->execute()){
                    $result3 = $stmt3->get_result();
                    if($result3->num_rows > 0){
                        $row3 = $result3->fetch_assoc();
                        $name = $row3['lastname'] . " " . $row3['firstname'];
                    }}
    
    ?>
       <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
       <div class="row gy-4">
    
    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item">
        <h3><?= $name; ?></h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#<?= $row3['date_of_birth'].' #'.$row3['gender'].' #'.$row3['department'].' #'.$row3['school']; ?></h4>
        <section id="testimonials" class="testimonials">
        <input type="hidden" name="teacher_id" value="<?= $id; ?>">
        <input type="hidden" name="yid" value="<?= $yid; ?>">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?= $row3['image']; ?>" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
       </form>
    
    </div>
    </section> 
            <button name="btn" class="buy-btn">Approve Teacher</button>
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
