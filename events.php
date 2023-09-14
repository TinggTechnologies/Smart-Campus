<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "header.php"; 

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
    <?php
    require "includes/pq-nav.php";
    ?>
    <section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <img src="./assets/img/easylearn/tutorial.png" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="text-center" style="font-size: 2rem; line-height: 1.3;">Create Events</h2>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur deleniti itaque odit maxime sapiente sit ex illum adipisci necessitatibus dolorem.</p>
                <form id="p_form" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
                    
                    <div class="input-group mb-4">
                       <input type="text" id="course_title" name="course_title" class="form-control" placeholder="Enter Course Title" required>
                    </div>
                    
                    <div class="input-group mb-4">
                       <input type="text" id="description" name="description" class="form-control" placeholder="Enter Assignment Description" required>
                    </div>
                    
                      <label for="submission_date">Event Date</label>
                    <div class="input-group mb-4">
                       <input type="date" name="submission_date" id="submission_date" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
                    </div>
                 
                    
                    <div class="form-group">
                        <button type="submit" name="assignment-btn" id="p_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).ready(function(){
        $('#p_form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var fileSize = $('#file')[0].files[0].size;
            var maxSize = 5000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/assignment-solver1.php',
                    type: 'POST',
                    data: formData,         
                    processData: false,
                    contentType: false,
                    success: function(response){
                        $('#message').html(response);
                      location.href = "select-teacher.php";
                    }
                });
            }
        });
        $('#p_form')[0].reset();
    });
</script>



