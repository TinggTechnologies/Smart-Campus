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
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> </a>
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive mt-3">
            
                <form id="registration_form" class="mt-3">

                <h2 class="text-center pb-3" style="font-size: 2rem;">Past Questions for all institutions</h2>
                <p class="text-center">Eazy Learn Past Question is a platform specially designed for students to easily download and sell past questions.</p>
                    
                    <div class="form-group mt-4 text-center">
                        <a href="./download-past-question.php" class="form-control getStarted-btn">Continue</a>
                    </div>

                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
