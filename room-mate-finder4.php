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
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Room Mate Finder</a>
            <img src="./assets/img/easylearn/intro2.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Make Your Choice</h2>
                <span style="color: rgb(214, 78, 101); font-weight: 500; font-size: 1.3rem;">Step 4 of 5</span>
                <form id="p_form">
                    <div class="input-group mb-4">
                        <select id="department" class="form-control">
                            <option value="">Select Department of your Room Mate</option>
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
                       <select id="level" class="form-control">
                        <option value="">Select Level</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                        <option value="600">600</option>
                       </select>
                    </div>
                    <div class="input-group mb-4" >
                      <select id="age" class="form-control">
                        <option value="">Select Age Range</option>
                        <?php
                            $sql = "SELECT * FROM age_range";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['age']; ?>"><?= $school_rows['age']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                      </select>
                    </div>
                    <div class="input-group mb-4">
                       <select id="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                       <select id="religion" class="form-control">
                        <option value="">Select Religion</option>
                        <option value="christian">Christian</option>
                        <option value="muslim">Muslim</option>
                        <option value="others">Others</option>
                       </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="p_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#p_btn', function(e){
        e.preventDefault();

        var department = $('#department').val();
        var gender = $('#gender').val();
        var level = $('#level').val();
        var religion = $('#religion').val();
        var age = $('#age').val();
       

        if(department == "" || gender == "" || level == "" || religion == "" || age == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/room_mate_finder4.php',
                type: 'post',
                data:
                {
                    department: department,
                    gender: gender,
                    level:level,
                    religion:religion,
                    age:age
                },
                success: function(response){
                    location.href = "room-mate-finder5.php";
                                 
                }
            });
            $('#p_form')[0].reset();
        }
    });
</script>