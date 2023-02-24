<?php 
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
  }
require "header.php"; ?>

<?php if(isset($_SESSION['code'])){
         $code =  $_SESSION['code'];
 } ?>

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
                <h2 class="pt-5">Verify Your Email</h2>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4">
                <div class="message"></div>

                    <div class="input-group">
                        <h6 style="line-height: 1.4; opacity: .7;">To finish registering, please enter the verification code we sent to <span class="text-primary"><?php if(isset($_SESSION['email'])){
                            echo $_SESSION['email'];
                        } ?></span>.<br /><br />
                        <span class="text-danger">It may take a few minutes to receive your code.</span>
                        </h6>
                    </div>

                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="code" placeholder="Enter Verification Code *">
                    </div>

                    <div class="input-group">
                        <input type="hidden" class="form-control" id="code_session" value="<?= $code; ?>">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="register_btn" class="form-control getStarted-btn">Submit</button>
                    </div>

                    <div class="text-center">
                       <span>Didn't receive the code?</span><br />
                       <a href="#" id="code_btn" class="text-primary" style="font-size: 1.2rem;">Resend Code</a>
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

        var code = $('#code').val();
        var code_session = $('#code_session').val();

        if(code != code_session){
            Swal.fire(
            'Invalid',
            'Enter a valid code',
            'error'
          )
        } else {
            location.href = "forgotten-password2.php";
        }

           
    });
    $(document).on('click', '#code_btn', function(e){
        e.preventDefault();

        var btn = $('#code_btn').val();

        if(code != ""){
            $.ajax({
                url: 'backend/resend-code.php',
                type: 'post',
                data: 
                {
                    btn: btn
                },
                success: function(data){
                    $('.message').html(response);
                }
            });
        }
    });
</script>