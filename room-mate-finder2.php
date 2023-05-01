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
                <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Room Mate Finder</a>
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">What best describes your employment status?</h2>
                <span style="color: blue; font-weight: 500; font-size: 1.3rem;">Step 2 of 5</span>
                <form id="status_form">
                    <div class="input-group mb-4">
                       <select name="status" id="status" class="form-control">
                         <option value="">What best describes your employment status?</option>
                         <option value="Student">Student</option>
                         <option value="Freelancer">Freelancer</option>
                         <option value="NYSC">NYSC</option>
                         <option value="Intern">Intern</option>
                         <option value="Professional">Professional</option>
                       </select>
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

        var status = $('#status').val(); 
        var user_id = $('#user_id').val();             

        if(status == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/room_mate_finder2.php',
                type: 'post',
                data:
                {
                    status: status,
                    user_id:user_id
                },
                success: function(response){
                    location.href = "room-mate-finder3.php";
                                 
                }
            });
            $('#status_form')[0].reset();
        }
    });
</script>