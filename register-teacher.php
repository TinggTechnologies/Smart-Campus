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
}$rm_sql = "SELECT * FROM register_teachers WHERE teacher_id=?";
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
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Join Team</a>
            <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Hi, <?= $_SESSION['lastname']; ?>!</h2>
                <span style="font-weight: 500; font-size: 1rem; opacity: .7; line-height: 1.5;">Thank you for wanting to be part of us, Our goal primarily is to simplify learning and we want you to join us to make this a reality. To continue we want to be sure that you are qualified enough to teach, so we will be asking you some important questions.</span>
                <form id="registration_form" class="mt-3">
<!--
                <h4 style="font-weight: bolder; opacity: .7; font-size: 1.3rem;">School: <span style="color: rgb(214, 78, 101);"><?= $row['school']; ?></span></h4>
                <h4 style="font-weight: bolder; opacity: .7; font-size: 1.3rem;">Faculty: <span style="color: rgb(214, 78, 101);"><?= $row['faculty']; ?></span></h4>
                <h4 style="font-weight: bolder; opacity: .7; font-size: 1.3rem;">Department: <span style="color: rgb(214, 78, 101);"><?= $row['department']; ?></span></h4> -->
                    
                    <div class="form-group mt-5 text-center">
                        <a href="register-teacher2.php" class="form-control getStarted-btn">Continue</a>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
