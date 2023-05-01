<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
require "database/connection.php"; 
require "header.php"; ?>

<?php if(isset($_SESSION['id'])){
         $id =  $_SESSION['id'];
 } 
 
 $sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $code = $row['code'];
    }
}
 ?>

<style>
    #code_btn:hover{
        color: red;
    }
</style>

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

                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="code" placeholder="Enter Verification Code *">
                    </div>

                    <div class="input-group mb-0">
                        <input type="hidden" class="form-control" id="code_session" value="<?= $code; ?>">
                    </div>

                    <div class="text-center mt-0 pt-0">
                       <a href="welcome.php" class="btn text-primary" style="font-size: 1.2rem; ">Verify Later</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="register_btn" class="form-control getStarted-btn">Submit</button>
                    </div>

                    <div class="text-center">
                       <span>Didn't receive the code?</span><br />
                       <button type="submit" id="code_btn" class="btn text-primary" style="font-size: 1.2rem; ">Resend Code</button>
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
            location.href = "welcome.php";
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