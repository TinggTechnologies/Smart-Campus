<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_GET['time'])){
  $time = $_GET['time'];
}
if(isset($_SESSION['id'])){
  $id = $_SESSION['id'];
}


$sql1 = "SELECT * FROM register_house WHERE timestamp='$time'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
    $row1 = $result1->fetch_assoc();
    $user_id = $row1['user_id'];

    $sql4 = "INSERT INTO visitors_clicks(visitor_id, owner_id, feature) VALUES(?,?,'hostel')";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param('ss', $user_id, $id);
        $stmt4->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Eazy Learn</title>
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

<style>
.contact_agent{
  background-color: rgba(255,255,255,.2);
  color: blue;
  padding: 1rem 1rem;
}
</style>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left text-black" style="margin-right: .5rem;"></i> Hostel Finder</a>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->


  <main id="main">

   <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing mt-0 pt-3">
      <div class="" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
              <h3><?= $row1['house_title']; ?></h3>
              <h4><sup>N</sup><?= $row1['price']; ?><span> / Year</span></h4>
              <h5>Town: <?= $row1['town']; ?></h5>
              <h5>House Type: <?= $row1['house_type']; ?></h5>
              <h5>Price Type: <?= $row1['price_type']; ?></h5>
              <h5>House Category: <?= $row1['house_category']; ?></h5>
              <?php
              if($row1['bedroom'] !== ""){
                ?>
              <p>Bedroom : <?= $row1['bedroom']; 
              
              ?></p>
              <?php
              }
              ?>
                 <?php
              if($row1['toilet'] !== ""){
                ?>
              <p>Toilet : <?= $row1['toilet']; 
              
              ?></p>
              <?php
              }
              ?>
              <?php
              if($row1['house_feature'] !== ""){
                ?>
              <p>Description: <?= $row1['house_feature']; 
              
              ?></p>
              <?php
              }
              ?>
              <section id="testimonials" class="testimonials">
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
                <img src="<?= $row['file']; ?>" class="testimonial-img" alt="">                 
              </div>
            </div>
    

    <?php
    }}
    ?>

              </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="mt-5">
          
        <h3 class="mb-2">Safety Tips</h3>
        <ol>
          <li>Do not make any inspection fee without seeing the agent and property.</li>
          <li>Make sure you pay only through Eazy Learn.</li>
          <li>If you don't pay through us then we won't be liable for any monetary transaction between you and the agent.</li>
          <li>Ensure you meet the Agent in an open location.</li>
          <li>Make payment after you have verified the house for security purposes.</li>
        </ol>
        <div class="text-end">
        <a href="" class="text-danger" style="font-size: 1.5rem; border-bottom: 2px solid red;">Report Property</a>
        </div>
        </div>

        <div class="mt-5">
          
          <h3 class="mb-5">Sellers Info</h3>
  
          <a class="contact_agent form-control"><i class="bi bi-envelope-open"></i> <?= $row1['contact_email']; ?></a><br />
          <a class="contact_agent form-control"><i class="bi bi-telephone"></i> <?= $row1['contact_phone']; ?></a><br />
          <a href="connect-agent.php?id=<?= $row1['user_id']; ?>" class="contact_agent form-control">Chat Agent</a>
          </div>

          <div class="mt-5 text-center">
          
          <h3 class="mb-2">Make Payment</h3>
          <p>Payment should only be made after you have verified the house and you are good with everything you have seen.</p>

          <form id="paymentForm">
          <div class="form-group">
                <input type="hidden" id="time" value="<?= $time; ?>"/>
            </div>
            <div class="form-group">
                <input type="hidden" id="email-address" value="<?= $_SESSION['email']; ?>" required />
            </div>
            <div class="form-group">
                <input type="hidden" value="<?=  $row['price']; ?>" id="amount" required />
            </div>
            <a href="ll.php?time=<?= $time; ?>" class="btn btn-primary w-100" onclick="payWithPaystack()" style="border-radius: 25px;">Pay Now</a>
            </form>
          
      
          </div>

          <div class="mt-5">
          
          <h3 class="mb-2">Safety Tips</h3>
          <ol>
            <li>Do not make any inspection fee without seeing the agent and property.</li>
            <li>Make sure you pay only through Eazy Learn.</li>
            <li>If you don't pay through us then we won't be liable for any monetary transaction between you and the agent.</li>
            <li>Ensure you meet the Agent in an open location.</li>
            <li>Make payment after you have verified the house for security purposes.</li>
          </ol>
          <div class="text-end">
          <a href="" class="text-danger" style="font-size: 1.5rem; border-bottom: 2px solid red;">Report Property</a>
          </div>
          </div>
  

      </div>
    </section> 

  </main><!-- End #main -->
  <script src="https://js.paystack.co/v1/inline.js"></script> 

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="js/jquery2.js"></script>
    <script src="./js/profile.js"></script>
    <script src="./assets/js/sweetalert.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>

<script>
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_c7e02b7b329cd65db9fb7a3321b5e2b9093465d6', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      window.location = "https://eazylearn.com.ng/home/dashboard.php?transaction=cancel";
      alert('Transaction cancelled.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference ;
      alert(message);
      window.location = "verify-pq-transaction.php?pq_id=" + <?= $item_id; ?> + "&reference=" + response.reference;
    }
  });

  handler.openIframe();
}
</script>