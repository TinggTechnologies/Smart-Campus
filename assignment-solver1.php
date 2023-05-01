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
    <section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Assignment Solver</a>
            <img src="./assets/img/easylearn/ass.jpg" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Assignment Solver</h2>
                <a href="#" style="color: blue; font-weight: 500; font-size: 1.1rem;">Edit Assignment</a>
                <form id="p_form" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
                    <div class="input-group mb-4">
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php
                            $sql = "SELECT * FROM department";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['department_name']; ?>"><?= $school_rows['department_name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                        </select>
                    </div>
                    <div class="input-group mb-4">
                       <input type="text" id="course_title" name="course_title" class="form-control" placeholder="Enter Course Title" required>
                    </div>
                    
                    <div class="input-group mb-4">
                       <input type="text" id="description" name="description" class="form-control" placeholder="Enter Assignment Description" required>
                    </div>
                    <div class="input-group mb-4">
                       <select id="no_of_pages" name="no_of_pages" class="form-control" required>
                        <option value="">Select number of pages</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                       </select>
                    </div>
                      <label for="submission_date">Enter Submission Date</label>
                    <div class="input-group mb-4">
                       <input type="date" name="submission_date" id="submission_date" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
                    </div>
                    <label for="">Assignment File</label>
                    <div class="input-group mb-4">
                       <input type="file" id="file" name="file" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
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



