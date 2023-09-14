<?php 
session_start();
if(isset($_SESSION['id'])){
  header("location: dashboard.php");
}
require "backend/login.php";
require "header.php";
?>

<style>

</style>

<body>
    <div class="row justify-content-center">
        <div class="col-lg-5">
        <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="login-form">
            <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/logo3.jpg" style="border-radius: 5px;" alt=""> 
      </a>
                <h2 class="pt-5">Log in to your account</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group text-center">
                    <div class="message">
                        <?php
                        if(isset($error['err_msg'])){
                            echo $error['err_msg'];
                        }
                        ?>
                    </div>
                </div>
                    <div class="input-group mb-5">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group" style="position: relative;"><a style="position: absolute; right: .3rem; bottom: 3rem;" href="forgotten-password.php" class="text-primary">Forgotten Password?</a>
                        <button type="submit" name="login-btn" class="form-control getStarted-btn">Log In</button>
                    </div>
                </form>
                <p>Have no account? <a href="register-names.php" class="text-primary">Sign Up</a></p>
            </div>
            
        </div>
    </section>
        </div>
    </div>
<?php require "footer.php"; ?>