<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "header.php"; 
require "backend/edit-single-pq.php";

if(isset($_GET['pq_id'])){
    $pq_id = $_GET['pq_id'];
}
$sql = "SELECT * FROM past_question WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $pq_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
?>
<body>
    <section class="container-fluid login-wrapper pt-3 pb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i></a>
            <img src="./assets/img/easylearn/assignment.png" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5 text-center" style="font-size: 2rem; line-height: 1.3;">Edit Past Question</h2>
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
      
                <form id="p_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                   
                    <div class="input-group mb-4">
                       <textarea type="text" id="course_title" name="course_title" class="form-control" required><?= $row['course_title']; ?> </textarea>
                    </div>

                  
  
                    <label for="">Past Question File</label>
                    <div class="input-group mb-4">
                       <input type="file" id="file" name="file" value="<?= $row['file']; ?>" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
                    </div>
                    <div class="input-group mb-4">
                    <input type="tel" id="price" name="price" class="form-control" value="<?= $row['price']; ?>" required>
                    </div>
                    <input type="hidden" value="<?= $pq_id; ?>" name="pq_id">
                    <input type="hidden" value="<?= $row['department']; ?>" name="department">
                    
                    <div class="form-group">
                        <button type="submit" name="pq-btn" id="p_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
