<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
require "header.php"; ?>

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

           <div class="row justify-content-center">
            <div class="col-lg-6">
            <div class="login-form">
            <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/logo3.jpg" style="border-radius: 5px;" alt=""> 
            </a>
                <h2 class="pt-5">Set your password</h2>
                <form role="form" action="">
                <div class="form-group mb-3">
                        <div id="message">
                           
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <input type="password" class="form-control" id="password" placeholder="Password *">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password *">
                    </div>
                    <div class="input-group mb-3">
                        <h6 style="line-height: 1.4; opacity: .7;">By clicking Agree & join, you agree to the Easy Learn <span style="color: rgb(214, 78, 101);">User Agreement</span>, <span style="color: rgb(214, 78, 101);">Privacy Policy</span>, and <span style="color: rgb(214, 78, 101);">Cookie Policy</span>.</h6>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="register_btn" class="form-control getStarted-btn">Agree & Join</button>
                    </div>
                </form>
               
            </div>
            </div>
           </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#register_btn', function(e){
        e.preventDefault();

        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        var strength = 0;

        if(password == "" || confirm_password == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
            } 
          else if(password.length < 8 || !/\d/.test(password) || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)){
            Swal.fire(
            'Invalid',
            'Password must be at least 8 characters and contain at least one lowercase letter, one uppercase letter, one digit and one special character',
            'error'
          )
            }else if(password !== confirm_password){
            Swal.fire(
            'Invalid',
            'Password does not match',
            'error'
          )
        }
        

        else{
            $.ajax({
                url: 'backend/password.php',
                type: 'post',
                data:
                {
                    password: password,
                    confirm_password: confirm_password
                },
                success: function(response){
                    $('#message').html(response);
                    location.href = "verify-email.php";
                }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>