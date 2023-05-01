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
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Cbt Game</a>
            <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Cbt Course Selection</h2>
                <a href="edit-pq.php" style="color:blue; font-weight: 500; font-size: 1.1rem;">Check Scores</a>
                <form id="pq_form" method="POST" enctype="multipart/form-data">
               <div class="message"></div>
                    <div class="input-group mb-4">
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Course</option>
                            <?php
                            $sql = "SELECT * FROM courses";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['name']; ?>"><?= $school_rows['name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                        </select>
                    </div>

                    <div class="input-group mb-4">
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Competitor</option>
                            <?php
                            $sql = "SELECT DISTINCT(user_id) FROM friends";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['user_id']; ?>"><?= $school_rows['user_id']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="pq-btn" id="p_btn" class="form-control getStarted-btn">Start Exam</button>
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
        $('#pq_form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var fileSize = $('#file')[0].files[0].size;
            var maxSize = 5000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/upload-pq.php',
                    type: 'POST',
                    data: formData,         
                    processData: false,
                    contentType: false,
                    success: function(response){
                        $('#message').html(response);
                        Swal.fire(
                            'Success',
                            'Uploaded Successfully',
                            'success'
                    )
                    }
                });
            }
        });
        $('#pq_form')[0].reset();
    });
</script>


