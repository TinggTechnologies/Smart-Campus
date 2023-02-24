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
                <h2 class="pt-5">Add your name</h2>
                <form id="registration_form">
                <div class="form-group mb-3">
                        <div id="message">
                           
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="first_name" placeholder="First name *">
                    </div>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="last_name" placeholder="Last name *">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="register_btn" class="form-control getStarted-btn">Continue</button>
                    </div>

                    <div class="input-group">
                        <input type="hidden" class="form-control" id="id" value="<?= bin2hex(random_bytes(4)); ?>">
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

        var firstname = $('#first_name').val();
        var lastname = $('#last_name').val();
        var id = $('#id').val();
        var btn = $('#register_btn').val();

        if(lastname == "" || firstname == "")
            {
          Swal.fire(
            'Invalid',
            'No Field should be empty',
            'error'
          )
        } else if(!/^[a-zA-Z\s]+$/.test(firstname)){
            Swal.fire(
            'Invalid',
            'Firstname cannot contain Letters and Spaces',
            'error'
          )
        }
        else if(!/^[a-zA-Z\s]+$/.test(lastname)){
            Swal.fire(
            'Invalid',
            'Lastname cannot contain Letters and Spaces',
            'error'
          )
        }

        else{
            $.ajax({
                url: 'backend/register-names.php',
                type: 'post',
                data:
                {
                    firstname: firstname,
                    lastname: lastname,
                    btn:btn,
                    id:id
                },
                success: function(response){
                    $('#message').html(response);
                    $('body').fadeOut();
                    location.href = "email.php";
                }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>