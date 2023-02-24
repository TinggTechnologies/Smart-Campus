<?php 
session_start();
if(isset($_SESSION['id'])){
  header("location: dashboard.php");
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
                <h2 class="pt-5">Forgotten Password </h2>
                <form id="registration_form">
                <div class="form-group mb-3">
                        <div id="message">
                           
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address*">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="register_btn" class="form-control getStarted-btn">Continue</button>
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

        var email = $('#email').val();
        var btn = $('#register_btn').val();

        if(email == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )

            } else{
            $.ajax({
                url: 'backend/forgotten-password.php',
                type: 'post',
                data:
                {
                    email: email,
                    btn:btn
                },
                success: function(response){
                    $('#message').html(response);
                    if(response == "yes"){
                        location.href = "v-email.php";
                          } else {
                            Swal.fire(
            'Invalid',
            'Email Does not Exists',
            'error'
          )
                
                }
            }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>