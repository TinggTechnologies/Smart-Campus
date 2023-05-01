<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    
}
if(isset($_GET['id'])){
    $friend_id = $_GET['id'];
    
}

$sql1 = "SELECT * FROM users WHERE user_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('s', $friend_id);
if($stmt1->execute()){
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
        $rows1 = $result1->fetch_assoc(); 
      
    
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
  <link href="assets/img/easylearn/logo2.jpg" rel="icon">
  <link href="assets/img/easylearn/logo2.jpg" rel="apple-touch-icon">

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

      <div class="section-header mt-2">
          
          <a href="javascript:history.back();" style="font-size: 1.4rem; margin-right: 4rem; color: rgba(0,0,0,1);"><i class="bi bi-arrow-left" style="margin-right: 4rem;"></i> Message Seller</a>

        </div>

<div class="fetch-room-mate">
<div class="row gy-4">

<div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
  <div class="pricing-item">
    <img src="uploads/<?= $rows1['image']; ?>" style="max-width: 100%; margin-bottom: 1rem;" alt="">
    <h3>Are you sure you want to message <span class="text-primary"><?= $rows1['lastname']; ?> <?= $rows1['firstname']; ?></span></h3>
    <form id="connect_form">
    <input type="hidden" id="friend_id" value="<?= $friend_id; ?>">
     <input type="hidden" id="user_id" value="<?= $id; ?>">

    <a id="connect_btn" class="buy-btn" style="cursor: pointer;">Yes</a>
    </form>
  </div>
</div><!-- End Pricing Item -->


</div>
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
<script src="./assets/js/sweetalert.js"></script>

</body>

</html>

<script>
    $(document).ready(function(){

    $(document).on('click', '#connect_btn', function(e){
        e.preventDefault();

        var friend_id = $('#friend_id').val();
        var user_id = $('#user_id').val();

            $.ajax({
                url: 'backend/insert-connect.php',
                type: 'post',
                data:
                {
                    friend_id: friend_id,
                    user_id:user_id
                },
                success: function(data){
                    if(data == "yes"){
                        Swal.fire(
            'Success',
            'User Already Friends, Check Friends List',
            'success'
          )
             
                    } else {
                    location.href = 'messages.php';
                    }
                    
                }
            });
            $('#connect_form')[0].reset();
        
    });


});                              
</script>

   
  