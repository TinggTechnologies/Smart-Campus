<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "header.php"; 
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
                <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Change Password</a>
            <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive mt-5">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Enter a More Secured Password?</h2>
                
                <form id="status_form">
                    <div class="input-group mb-5">
                       <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                    </div>
                    <div class="input-group mb-5">
                       <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                    </div>
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                    
                    <div class="form-group">
                        <button type="submit" id="status_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#status_btn', function(e){
        e.preventDefault();

        var password = $('#password').val(); 
        var confirm_password = $('#confirm_password').val(); 
        var user_id = $('#user_id').val();             

        if(password == "" || confirm_password == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        } else if(password.length < 6){
            Swal.fire(
            'Invalid',
            'Password must be greater than 6',
            'error'
          )
        } else if(password !== confirm_password){
            Swal.fire(
            'Invalid',
            'Password does not match',
            'error'
          )
        }
        
        else {
            $.ajax({
                url: 'backend/change-password.php',
                type: 'post',
                data:
                {
                    password: password,
                    confirm_password: confirm_password,
                    user_id:user_id
                },
                success: function(response){
                    Swal.fire(
                    'Success',
                    'Password Successfully changed',
                    'success'
                )
                                 
                }
            });
            $('#status_form')[0].reset();
        }
    });
</script>