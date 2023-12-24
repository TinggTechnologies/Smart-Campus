<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
require "includes/login-header.php"; ?>

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

           <div class="row justify-content-center">
            <div class="col-lg-6">
                
            <div class="login-form">
            <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/logo-cut2.png" style="border-radius: 5px; width: 7rem; height: 4rem;" alt="">
                </a>
                                  
            <img src="./assets/img/easylearn/success.gif" class="pre-login-img img-responsive">
                <h2 class="pt-5">Dear, <span class="text-primary"><?php if(isset($_SESSION['lastname'])){
                            echo $_SESSION['lastname'];
                        } ?>!</span></h2>
                <form role="form" action="" class="mt-4">

                    <div class="input-group mb-4">
                        <h6 style="line-height: 1.4; opacity: .8;">
                        We're thrilled to welcome you to Smart Campus, your one-stop shop for all your educational needs. Congratulations on taking the first step towards unlocking your full potential!. <br /><br />At Smart Campus, we're committed to providing you with the best learning experience possible. Our platform is here to support you every step of the way.
                        </h6>
                    </div>

                    <div class="form-group">
                        <a href="upload-image.php" class="form-control getStarted-btn text-center">Continue</a>
                    </div>

                </form>
               
            </div>
            </div>
           </div>
           
        </div>
    </section>
<?php require "includes/login-footer.php"; ?>
