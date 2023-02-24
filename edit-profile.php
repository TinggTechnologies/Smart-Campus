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
                    <img src="<?= $row['image']; ?>" style="width: 10rem; border-radius: 50%;" alt="">
                    <a href="edit-photo.php" class="text-primary">Change Photo</a>
                    </div>
                    <div class="input-group mb-5 mt-3">
                       <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $row['firstname']; ?>" >
                    </div>
                    <div class="input-group mb-4">
                       <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $row['lastname']; ?>">
                    </div>
                    <div class="input-group mb-4">
                       <input type="email" class="form-control" name="email" id="email" value="<?= $row['email']; ?>">
                    </div>
                    <div class="input-group mb-4">
                       <input type="tel" class="form-control" name="telephone" id="telephone" value="<?= $row['telephone']; ?>">
                    </div>
                    <div class="input-group mb-4">
                       <input type="date" class="form-control" name="date" id="date" value="<?= $row['date_of_birth']; ?>">
                    </div>
                    <div class="input-group mb-4">
                    <select name="gender" id="gender" class="form-control">
                         <option value="<?= $row['gender']; ?>"><?= $row['gender']; ?></option>
                         <option value="male">Male</option>
                         <option value="female">Female</option>
                       </select>
                    </div>
                    <div class="input-group mb-4">
                       <select name="school" id="school" class="form-control">
                         <option value="<?= $row['school']; ?>"><?= $row['school']; ?></option>
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
                    <div class="input-group mb-4">
                    <select name="faculty" id="faculty" class="form-control">
                    <option value="<?= $row['faculty']; ?>"><?= $row['faculty']; ?></option>
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
                    <option value="<?= $row['department']; ?>"><?= $row['department']; ?></option>
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
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                   
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#update_btn', function(e){
        e.preventDefault();

        var firstname = $('#firstname').val(); 
        var lastname = $('#lastname').val(); 
        var email = $('#email').val();   
        var telephone = $('#telephone').val(); 
        var date = $('#date').val();      
        var gender = $('#gender').val(); 
        var school = $('#school').val();   
        var faculty = $('#faculty').val(); 
        var department = $('#department').val();    

        if(firstname == "" || lastname == "" || email == "" || telephone == "" || date == "" || gender == "" || school == "" || faculty == "" || department == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/edit-profile.php',
                type: 'post',
                data:
                {
                    firstname: firstname,
                    lastname: lastname,
                    email:email,
                    telephone: telephone,
                    date: date,
                    gender:gender,
                    school: school,
                    faculty: faculty,
                    department:department
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