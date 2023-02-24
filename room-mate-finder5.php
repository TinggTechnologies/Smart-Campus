<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "header.php"; ?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Room Mate Finder</a>
            <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Almost Done <?= $_SESSION['lastname']; ?>!</h2>
                <span style="color: rgb(214, 78, 101); font-weight: 500; font-size: 1.3rem;">Step 5 of 5</span>
                <form id="registration_form">
                    <div class="input-group mb-4">
                        <input type="tel" id="budget" class="form-control" placeholder="Whats your budget on a hostel?">
                    </div>
                    <label for="time">Time you would love to move in</label><br /><br />
                    <div class="input-group mb-5">
                        <input type="date" id="time" class="form-control" placeholder="and I would like to move in">
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

        var budget = $('#budget').val();
        var time = $('#time').val();
    
        if(budget == "" || time == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/room_mate_finder5.php',
                type: 'post',
                data:
                {
                    budget: budget,
                    time: time
                },
                success: function(response){
                    location.href = "room-mate-finder6.php";
                                 
                }
            });
            $('#registration_form')[0].reset();
        }
    });
</script>