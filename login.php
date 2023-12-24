<?php 
session_start();
if(isset($_SESSION['id'])){
  header("location: dashboard.php");
}
require "backend/login.php";
require "includes/login-header.php";
?>

<style>
  @keyframes moveImage {
    0% {
      transform: translateX(0%);
    }
    100% {
      transform: translateX(100%);
    }
  }

  .moving-image {
    animation: moveImage 5s linear infinite; /* Adjust the duration as needed */
    width: 100%; /* Adjust the width of the image container */
    overflow: hidden;
  }
</style>

<body>
    <div class="row justify-content-center text-center">
        <div class="col-lg-5">
        <section class="container-fluid login-wrapper pt-0">
        <div class="container">

            <div class="login-form">
            <div class="moving-image">
            <a href="#" class="logo d-flex align-items-center leo">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/student3.gif" style="border-radius: 5px; margin-top: 2rem;" alt=""> 
      </a>
            </div>
                <h2 class="pt-0" style="font-size: 1.5rem;">Login to your account</h2>
                <form method="POST" class="mt-0 pt-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group text-center">
                    <div class="message">
                        <?php
                        if(isset($error['err_msg'])){
                            echo $error['err_msg'];
                        }
                        ?>
                    </div>
                </div>
                    <div class="input-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" style="border: 1px solid black; border-radius: 5px;">
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" name="password" class="form-control" placeholder="Password" style="border: 1px solid black; border-radius: 5px;">
                    </div>
                    <div class="form-group" style="position: relative;"><a style="position: absolute; right: .3rem; bottom: 3rem" href="forgotten-password.php" class="text-primary">Forgotten Password?</a>
                        <button type="submit" name="login-btn" class="form-control getStarted-btn">Log In</button>
                    </div>
                </form>
                <p>Have no account? <a href="register-names.php" class="text-primary">Sign Up</a></p>
            </div>
            
        </div>
    </section>
        </div>
    </div>
<?php require "includes/login-footer.php"; ?>