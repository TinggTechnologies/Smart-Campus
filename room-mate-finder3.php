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
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
require "backend/room_mate_finder3.php";
?>

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Room Mate Finder</a>
            <img src="./assets/img/easylearn/intro3.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive" >
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Bio Data</h2>
                <span style="color: blue; font-weight: 500; font-size: 1.3rem;">Step 3 of 5</span>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-4">
                        <?php 
                           if(isset($error['file'])){
                            echo $error['file'];
                           }
                        ?>
                        <label for="file">We recommend a selfie image with dimension 500 x 500</label>
                      <input type="file" name="file" id="file" style="border: 2px solid rgba(0,0,0,.7);" class="form-control">
                    </div>
                   
                    <div class="input-group mb-4">
                      <textarea style="height: 5rem;" class="form-control" name="bio" id="bio_data" placeholder="Tell us a little about yourself and what you are looking for"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="btn" id="bio_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "includes/login-footer.php"; ?>
