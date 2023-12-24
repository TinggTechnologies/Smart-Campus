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
        <img src="assets/img/easylearn/logo-cut.png" style="border-radius: 5px; width: 4rem; height: 4rem; margin-left: 8.5rem;" alt="">
                </a> 
                <h2 class="pt-5">Add your email and phone </h2>
                <form id="registration_form">
                <div class="form-group mb-3">
                        <div id="message d-none">
                           
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <input type="email" class="form-control" id="email" placeholder="Email *">
                    </div>
                    <div class="input-group mb-5">
                        <input type="tel" class="form-control" id="phone" placeholder="Phone *">
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
<?php require "includes/login-footer.php"; ?>
<script>
    $(document).on('click', '#register_btn', function(e){
        e.preventDefault();

        var email = $('#email').val();
        var phone = $('#phone').val();
        var btn = $('#register_btn').val();
        var atpos = email.indexOf('@');
        var dotpos = email.lastIndexOf('.com');
        var phone_checker = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(phone);
        var email_checker = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);

        if(email == "" || phone == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        } else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){
            Swal.fire(
            'Invalid',
            'Invalid Email',
            'error'
          )
        } else if(!email_checker){
            Swal.fire(
            'Invalid',
            'Invalid Email',
            'error'
          )
        } else if(!phone_checker){
            Swal.fire(
            'Invalid',
            'Invalid Telephone',
            'error'
          )
        } 
        else if(phone.length !== 11){
            Swal.fire(
            'Invalid',
            'Telephone Digit must be 11',
            'error'
          );
        } //else if(/^[0-9]+$/){
            //document.getElementById("message").innerHTML = "<div class='alert alert-danger'>Invalid Telephone</div>";
        //}

        else{
            $.ajax({
                url: 'backend/email.php',
                type: 'post',
                data:
                {
                    email: email, 
                    phone: phone,
                    btn:btn
                },
                success: function(response){
                    
                    $('#message').html(response);
                    if(response == "no"){
                        location.href = "password.php";
                          } else {
                            Swal.fire(
            'Invalid',
            'Email Already Exists',
            'error'
          )
                
                }
            }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>