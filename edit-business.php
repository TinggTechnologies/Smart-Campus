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

$sql1 = "SELECT * FROM register_business WHERE user_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('s', $id);
if($stmt1->execute()){
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
        $row1 = $result1->fetch_assoc();
    }
}
require "backend/edit-business.php";
?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Register Business</a>
           
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3; color: blue;">Edit Business Profile</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

                <div class="input-group mb-4">
                <?php 
                           if(isset($error['file'])){
                            echo $error['file'];
                           }
                        ?>
                     <input type="text" name="business_name" id="business_name" value="<?= $row1['business_name']; ?>" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                        <label for="file">For security we need a screenshot of your NIN</label>
                      <input type="file" name="file" id="file" style="border: 2px solid rgba(0,0,0,.7);" class="form-control">
                    </div>
                   
                    <div class="input-group mb-4">
                      <textarea style="height: 5rem;" class="form-control" name="about" id="about"><?= $row1['about']; ?></textarea>
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="state" id="state" value="<?= $row1['state']; ?>" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="city" id="city" value="<?= $row1['city']; ?>" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="address" id="address" value="<?= $row1['address']; ?>" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                     <input type="text" name="postal_code" id="postal_code" value="<?= $row1['postal_code']; ?>" class="form-control">
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
