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
require "backend/register-business.php";
?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Register Business</a>
           
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Register Your Business</h2>
                <span style="color: rgb(214, 78, 101); font-weight: 500; font-size: 1.3rem;">Step 1 of 1</span>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

                <div class="input-group mb-4">
                <?php 
                           if(isset($error['file'])){
                            echo $error['file'];
                           }
                        ?>
                     <input type="text" name="business_name" id="business_name" placeholder="Enter Business Name" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                        <label for="file">For security we need a screenshot of your NIN</label>
                      <input type="file" name="file" id="file" style="border: 2px solid rgba(0,0,0,.7);" class="form-control">
                    </div>
                   
                    <div class="input-group mb-4">
                      <textarea style="height: 5rem;" class="form-control" name="about" id="about" placeholder="Tell us a little about your Business"></textarea>
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="state" id="state" placeholder="The state where the Business is located" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="city" id="city" placeholder="The City/Town where the Business is located" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="address" id="address" placeholder="The Address where the Business is located" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="btn" id="btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
