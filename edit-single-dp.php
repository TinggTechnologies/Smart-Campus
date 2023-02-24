<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "header.php"; 
require "backend/edit-single-dp.php";

if(isset($_GET['dp_id'])){
    $dp_id = $_GET['dp_id'];
}
$sql = "SELECT * FROM tutorial WHERE tutorial_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $dp_id);
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
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Donate Pdf</a>
            <img src="./assets/img/easylearn/ass.jpg" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Edit Donate Pdf</h2>
      
                <form id="p_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group text-center">
                                <div class="message">
                                <?php 
                           if(isset($error['file'])){
                            echo $error['file'];
                           }
                        ?>
                                </div>
                            </div>
                                <div class="input-group mb-5">
                                    <input type="text" name="course_title" id="course_title" class="form-control" value="<?= $row['course_title']; ?>" required>
                                </div>

                                <div class="form-group mb-5">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="description" id="desc"  required><?= $row['description']; ?></textarea>
                                  </div>
            
                                <div class="mb-5" >  
                                    <label for="file">Upload Pdfs</label>
                                    <input class="form-control" type="file" id="file" name="file" placeholder="Upload Pdfs" required>
                                </div>
                                <input type="hidden" value="<?= $dp_id; ?>" name="dp_id">
            
                                <div class="form-group mt-5">
                                    <button type="submit" name="dp-btn" id="donate-pdf-btn" class="form-control getStarted-btn">Upload</button>
                                </div>
                                
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
