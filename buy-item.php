<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
}

$sql = "SELECT * FROM sell WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $item_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
            }
            }
        }
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
  background-color: blue;
  color: #fff;
  padding: 1rem 0;
}
</style>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="javascript:history.back();" style="font-size: 1.2rem;"><i class="bi bi-arrow-left text-black" style="margin-right: .5rem;"></i> Listings</a>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->


  <main id="main">

   <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
                <img src="<?= $row['image']; ?>" alt="" style="max-width: 100%;" class="mb-3">
              <h3><?= $row['item_name']; ?></h3>
              <h4><sup>N</sup><?= $row['price']; ?></h4>
              <h5>Category: <?= $row['category']; ?></h5>
             
        <div class="mt-5">
          
        <h3 class="mb-5">Sellers Info</h3>

        <a class="contact_agent form-control text-center"><?= $row1['email']; ?></a><br />
        <a class="contact_agent form-control text-center"><?= $row1['telephone']; ?></a><br />
        <a href="connect-seller.php?id=<?= $row1['user_id']; ?>" class="contact_agent form-control text-center">Chat Seller</a><br />
        <p class="text-danger">Note: Never send any money to any seller until you have confirmed the item. make sure you meet the seller in an open environment. Contact us immediately you feel you have been defrauded(09048480552).</p>
        </div>

      </div>
    </section> 

  </main><!-- End #main -->

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
<script src="assets/js/main.js"></script>

</body>

</html>