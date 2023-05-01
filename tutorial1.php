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
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i></a>
             <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive"> 
            
                <form id="registration_form" class="mt-3">

                <h3 class="text-center">Download Tutorial</h3>
                <p class="text-center">Eazy Learn Tutorial is a platform specially designed for students to easily download and sell tutorials whether in Video, text or pictorial format.</p>
                    
                    <div class="form-group mt-4 text-center">
                        <a href="download-tutorial.php" class="form-control getStarted-btn">Download Tutorial</a>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
