<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "includes/login-header.php"; 

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
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Upload Item</a>
            <img src="./assets/img/easylearn/thankyou.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive mt-5">
            
                <form id="registration_form" class="mt-5">
                    <p>You have successfully editted this item.</p>
                    
                    <div class="form-group mt-4 text-center">
                        <a href="dashboard.php" class="form-control getStarted-btn">Go to Dashboard</a>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "includes/login-footer.php"; ?>
