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
require "backend/register-teacher3.php";
?>

<body>
    <section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Join Team</a>
            <img src="./assets/img/easylearn/intro5.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive" >
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Upload Document</h2>
                <span style="color: blue; font-weight: 500; font-size: 1.3rem;">Step 2 of 3</span>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4" enctype="multipart/form-data">
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
                <p class="pb-4">To know if you are really qualified to teach, solve assignments or upload tutorials, we need a screenshot of your last GPA/CGPA.
            </p>
            <div class="form-group mb-4">
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button name="btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
