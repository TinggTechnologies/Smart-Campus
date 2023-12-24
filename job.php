<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "includes/login-header.php"; 
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

$rm_sql = "SELECT * FROM register_teachers WHERE teacher_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    @$stud = $rm_row['status'];
   }
}

if(@$stud == 'pending'){
    echo "<script>location.href = 'register-teacher4.php';</script>"; 
} else if(@$stud == 'active'){
    echo "<script>location.href = 'teacher-dashboard.php';</script>"; 
}

$rm_sql = "SELECT * FROM register_house WHERE user_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    @$hstud = $rm_row['status'];
   }
}

if(@$hstud == 'pending'){
    echo "<script>location.href = 'approved.php';</script>"; 
} else if(@$hstud == 'active'){
    echo "<script>location.href = 'agent-dashboard.php';</script>"; 
}

$rm_sql = "SELECT * FROM register_business WHERE user_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    @$bstud = $rm_row['status'];
   }
}

if(@$bstud == 'pending'){
    echo "<script>location.href = 'approved.php';</script>"; 
} else if(@$bstud == 'active'){
    echo "<script>location.href = 'business-dashboard.php';</script>"; 
}

   ?>


<body>
    <section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
                <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Join Team</a>
            <img src="./assets/img/easylearn/job.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive mt-5">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Join Our Team</h2>
                
                <form id="job_form" class="mt-4">
                <p>Our goal is to make learning stress free and more conducive for students and we cannot do it alone, so we are calling on you to join our team.<br /><br />
            Note: <span class="text-danger">You can only have just one job at Easy Learn</span>
            </p>
                    <div class="input-group mb-5">
                      <select name="job" id="job" class="form-control">
                        <option value="">Select Job</option>
                        <?php
                            $sql = "SELECT * FROM job";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['jobs']; ?>"><?= $school_rows['jobs']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                      </select>
                    </div>
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                    <div class="form-group">
                        <button type="submit" id="job_btn" class="form-control getStarted-btn">Join Team</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>

<?php require "includes/login-footer.php"; ?>
<script>
    $(document).on('click', '#job_btn', function(e){
        e.preventDefault();

        var job = $('#job').val(); 
        var user_id = $('#user_id').val();             

        if(job == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/job.php',
                type: 'post',
                data:
                {
                    job: job,
                    user_id:user_id
                },
                success: function(response){
                    if(job == "Transport"){
                        location.href = "unavailable.php";
                    } else if(job == "Business"){
                        location.href = "register-business.php";
                    }
                    else if(job == "Teacher"){
                        location.href = "register-teacher.php";
                    }
                    else if(job == "Agent"){
                        location.href = "hostel-agent.php";
                    }  else if(job == "Easy Learn Agent"){
                        location.href = "unavailable.php";
                    } 
                                 
                }
            });
            $('#job_form')[0].reset();
        }
    });
</script>