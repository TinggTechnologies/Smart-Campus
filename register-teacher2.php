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
        $department = $row['department'];
    }
}
require "backend/room_mate_finder3.php";
?>

<body>
    <section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Join Team</a>
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive" >
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Job Experience</h2>
                <span style="color: blue; font-weight: 500; font-size: 1.3rem;">Step 1 of 3</span>
                <form id="job_form">
                    <div id="message"></div>
                    <div class="input-group mb-4">                 
                      <input type="tel" name="experience" id="experience" class="form-control" placeholder="How many years of Experience?(0-10)">
                    </div>

                    <div class="input-group mb-4">                 
                      <input type="text" name="office" id="office" class="form-control" placeholder="The name of the place you taught in?">
                    </div>

                    <div class="input-group mb-5">                 
                      <select name="area" id="area" class="form-control">
                        <option value="">Pick an Area that best suites you</option>
                        <option value="assignment">solving assignment</option>
                        <option value="notes">making tutorial notes / Videos</option>
                        <option value="project">Writing Students Projects</option>
                      </select>
                    </div>
                    <input type="hidden" name="department" id="department" value="<?= $department; ?>">
                    
                    <div class="form-group">
                        <button type="submit" name="job_btn" id="job_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>

<script>
    $(document).on('click', '#job_btn', function(e){
        e.preventDefault();

        var experience = $('#experience').val();
        var office = $('#office').val();
        var area = $('#area').val();
        var department = $('#department').val();
  

        if(office == "" || experience == "" || area == "")
            {
          Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }

        else{
            $.ajax({
                url: 'backend/register-teacher2.php',
                type: 'post',
                data:
                {
                    experience: experience,
                    office: office,
                    area:area,
                    department:department
                },
                success: function(response){
                    $('#message').html(response);
                    $('body').fadeOut();
                    location.href = "register-teacher3.php";
                }
            });
            $('#job_form')[0].reset();
        }
    });
</script>