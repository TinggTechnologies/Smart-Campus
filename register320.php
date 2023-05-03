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
                <h2 class="pt-5">Register Project</h2>
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
                    <div class="input-group mb-5">
                        <input type="email" class="form-control" id="email" placeholder="Email *">
                    </div>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="project_topic" placeholder="Project Topic *">
                    </div>
                    <div class="input-group mb-5">
                        <textarea type="text" class="form-control" id="project_desc" style="height: 7rem;">Enter Project Description</textarea>
                    </div>
                    <div class="input-group mb-5">
                        <select name="group" id="group" class="form-control">
                            <option value="">How many in a group?</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="supervisor_name" placeholder="Supervisor Name *">
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

        var firstname = $('#first_name').val();
        var lastname = $('#last_name').val();
        var email = $('#email').val();
        var project_topic = $('#project_topic').val();
        var project_desc = $('#project_desc').val();
        var group = $('#group').val();
        var supervisor_name = $('#supervisor_name').val();
        var btn = $('#register_btn').val();
        var atpos = email.indexOf('@');
        var dotpos = email.lastIndexOf('.com');
        var email_checker = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);


        if(lastname == "" || firstname == "" || project_topic == "" || project_desc == "" || group == "" || supervisor_name == "" || email == "")
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
        }else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){
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
        }

        else{
            $.ajax({
                url: 'backend/register320.php',
                type: 'post',
                data:
                {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    project_topic: project_topic,
                    project_desc: project_desc,
                    supervisor_name: supervisor_name,
                    group: group,
                    btn:btn,
                },
                success: function(response){
                    $('#message').html(response);
                    $('body').fadeOut();
                    location.href = "320success.php";
                }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>