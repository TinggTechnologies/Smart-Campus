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
$sql = "SELECT * FROM roommate_finder WHERE user_id=?";
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
                <div class="d-flex justify-content-between align-items-center">
                <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-x-lg text-danger" style="margin-right: .5rem;"></i> Edit Profile</a>
                <i class="bi bi-check-lg text-success" id="update_btn" style="font-size: 2rem; cursor: pointer;"></i>
                </div>
                
                <form id="status_form">
                    <div class="text-center">
                    <img src="<?= $row['selfie']; ?>" style="width: 10rem; border-radius: 50%;" alt="">
                    <a href="edit-room-mate-photo.php" class="text-primary">Change Photo</a>
                    </div>
                    <div class="input-group mb-4 mt-3">
                    <select name="profile" id="profile" class="form-control">
                         <option value="<?= $row['hostel_profile']; ?>"><?= $row['hostel_profile']; ?></option>
                         <option value="Moving Into An Apartment And Looking For Roommates To Join You?">Moving Into An Apartment And Looking For Roommates To Join You?</option>
                         <option value="Already Living In An Apartment And Looking For Roommates To Split The Bill?">Already Living In An Apartment And Looking For Roommates To Split The Bill?</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                    <select name="status" id="status" class="form-control">
                         <option value="<?= $row['employment_status']; ?>"><?= $row['employment_status']; ?></option>
                         <option value="Student">Student</option>
                         <option value="Freelancer">Freelancer</option>
                         <option value="NYSC">NYSC</option>
                         <option value="Intern">Intern</option>
                         <option value="Professional">Professional</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                    <textarea style="height: 5rem;" class="form-control" name="bio" id="bio_data"><?= $row['bio_data']; ?></textarea>
                    </div>
                    <div class="input-group mb-4">
                    <select id="level" class="form-control">
                    <option value="<?= $row['level']; ?>"><?= $row['level']; ?></option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                        <option value="600">600</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group mb-4">
                       <select id="religion" class="form-control">
                       <option value="<?= $row['religion']; ?>"><?= $row['religion']; ?></option>
                        <option value="christian">Christian</option>
                        <option value="muslim">Muslim</option>
                        <option value="others">Others</option>
                       </select>
                    </div>
                    </div>
                    <div class="input-group mb-4">
                    <select name="gender" id="gender" class="form-control">
                         <option value="<?= $row['gender']; ?>"><?= $row['gender']; ?></option>
                         <option value="male">Male</option>
                         <option value="female">Female</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                    <select id="age" class="form-control">
                    <option value="<?= $row['age_range']; ?>"><?= $row['age_range']; ?></option>
                        <?php
                            $sql = "SELECT * FROM age_range";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($age_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $age_rows['age']; ?>"><?= $age_rows['age']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                      </select>
                    </div>

                    <div class="input-group mb-4">
                    <input type="tel" id="budget" class="form-control" value="<?= $row['budget']; ?>">
                    </div>

                    <div class="input-group mb-4">
                    <input type="date" id="time" class="form-control" value="<?= $row['hostel_date']; ?>">
                    </div>

                    <div class="input-group mb-4">
                    <select name="department" id="department" class="form-control">
                    <option value="<?= $row['department']; ?>"><?= $row['department']; ?></option>
                         <?php
                            $sql = "SELECT * FROM department";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($age_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $age_rows['department_name']; ?>"><?= $age_rows['department_name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                       </select>
                    </div>

                    <div class="input-group mb-4">
                    <select name="connect" id="connect" class="form-control">
                         <option value="">Have you seen a room mate?</option>
                         <option value="no">no</option>
                         <option value="yes">yes</option>
                       </select>
                    </div>
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                   
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "includes/login-footer.php"; ?>
<script>
    $(document).on('click', '#update_btn', function(e){
        e.preventDefault();

        var profile = $('#profile').val(); 
        var status = $('#status').val(); 
        var bio_data = $('#bio_data').val();   
        var level = $('#level').val(); 
        var religion = $('#religion').val();      
        var gender = $('#gender').val(); 
        var age = $('#age').val();   
        var budget = $('#budget').val(); 
        var department = $('#department').val();
        var connect = $('#connect').val();  
        var time = $('#time').val();       

        if(profile == "" || status == "" || bio_data == "" || level == "" || religion == "" || gender == "" || age == "" || budget == "" || department == "" || connect == "" || time == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/edit-room-mate-profile.php',
                type: 'post',
                data:
                {
                    profile: profile,
                    status: status,
                    bio_data:bio_data,
                    level: level,
                    religion: religion,
                    gender:gender,
                    age: age,
                    budget: budget,
                    department:department,
                    connect:connect,
                    time: time
                },
                success: function(data){
                    Swal.fire(
                    'Success',
                    'Profile Successfully updated',
                    'success'
                )
                                 
                }
            });
            $('#status_form')[0].reset();
        }
    });
</script>