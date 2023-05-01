<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "header.php"; ?>

<?php
require "./database/connection.php"; 

?>

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
            <img src="./assets/img/easylearn/student4.gif" style="border-radius: 10px; padding-right: 5rem;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Let's Know More About You</h2>
                <form id="student_form">
                    <div class="input-group mb-3">
                       <select name="school" id="school" class="form-control">
                         <option value="">Name of your school</option>
                         <?php
                            $sql = "SELECT * FROM school";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['school_code']; ?>"><?= $school_rows['school_name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                       </select>
                    </div>
                    <div class="input-group mb-3">
                    <select name="faculty" id="faculty" class="form-control">
                         <option value="">Name of your Faculty</option>
                         <?php
                            $sql = "SELECT * FROM faculty";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['faculty_name']; ?>"><?= $school_rows['faculty_name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                       </select>
                    </div>
                    
                    <div class="input-group mb-5">
                    <select name="department" id="department" class="form-control">
                         <option value="">Name of your Department?</option>
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
                    
                    <div class="form-group">
                        <button type="submit" id="student_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#student_btn', function(e){
        e.preventDefault();

        var school= $('#school').val();
        var faculty = $('#faculty').val();
        var department = $('#department').val();
       

        if(school == "" || faculty == "" || department == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/insert-school.php',
                type: 'post',
                data:
                {
                    school: school,
                    faculty: faculty,
                    department:department
                },
                success: function(response){
                    location.href = "dashboard.php";
                    
                }
            });
            $('#student_form')[0].reset();
        }
    });
</script>