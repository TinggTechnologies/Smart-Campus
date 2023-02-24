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

$rm_sql = "SELECT * FROM users WHERE user_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    $stud = $rm_row['student'];
   }
}

if($stud == 'no'){
    echo "<script>location.href = 'not-student.php';</script>"; 
}
?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Pick Room Mate</a>
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive mt-5">
            
                <form id="registration_form" class="mt-3">

                    <div class="form-group mt-5 text-center">
                        <a href="room-mate-finder6.php" class="form-control getStarted-btn" style="background: #030a23;">Pick Room Mate</a>
                    </div>
                    
                    <div class="form-group mt-4 text-center">
                        <a href="./connect-with-roommate.php" class="form-control getStarted-btn">Connect with Room Mate</a>
                    </div>

                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
