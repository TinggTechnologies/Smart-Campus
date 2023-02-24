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
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 1.7rem; line-height: 1.3;">Your profile helps you to discover people and opportunities</h2>
                <form id="registration_form">

                    <div class="input-group mb-3">
                    <select name="gender" id="gender" class="form-control">
                         <option value="">Gender</option>
                         <option value="male">Male</option>
                         <option value="female">Female</option>
                       </select>
                    </div>
                    <div class="mb-4">
                        <span class="">Date of Birth</span>
                    <input type="date" class="form-control mt-2" id="date_of_birth" style="border: 1px solid rgba(0,0,0,.2); border-radius: 5px;">
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

        var gender = $('#gender').val();
        var date_of_birth = $('#date_of_birth').val();
        var user = $('#user').val();
       

        if(gender == "" || date_of_birth == "" || user == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/get_data.php',
                type: 'post',
                data:
                {
                    gender: gender,
                    date_of_birth:date_of_birth,
                    user:user
                },
                success: function(response){
                    location.href = "student.php";
                                 
                }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>