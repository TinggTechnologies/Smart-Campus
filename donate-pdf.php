<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
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

require "header.php";
?>


<section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Donate Pdf</a>
            <img src="./assets/img/easylearn/ass.jpg" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Donate Pdf</h2>
                <a href="edit-donate-pdf.php" style="color: blue; font-weight: 500; font-size: 1.1rem;">Edit Pdf</a>
                <form id="dp_form" class="pt-0 mt-3" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
                <p>Help Eazy Learn by donating the PDF you have for other students to have access to. You can also monetize your books by registering as a teacher.</p>
                                <div class="input-group mb-5">
                                    <input type="text" name="title" id="course_title" class="form-control" placeholder="Course Title" required>
                                </div>

                                <div class="form-group mb-5">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" id="desc" required></textarea>
                                  </div>
            
                                <div class="mb-5" >  
                                    <label for="file">Upload Pdfs</label>
                                    <input class="form-control" type="file" id="file" name="file" placeholder="Upload Pdfs" required>
                                </div>
            
                                <div class="form-group mt-5">
                                    <button type="submit" name="donate-pdf-btn" id="donate-pdf-btn" class="form-control getStarted-btn">Upload</button>
                                </div>
                                
                            </form>
                            
                        </div>
                </div>
            </div>
            
            
        </div>
    </section>
    <?php require "footer.php"; ?>
    <script src="js/jquery2.js"></script>
    <script src="js/index.js"></script>
    <script src="./assets/js/sweetalert.js"></script>
</body>
    </html>
    <script>
    $(document).ready(function(){
        $('#dp_form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var fileSize = $('#file')[0].files[0].size;
            var maxSize = 5000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/donate-pdf.php',
                    type: 'POST',
                    data: formData,         
                    processData: false,
                    contentType: false,
                    success: function(response){
                        $('#message').html(response);
                        Swal.fire(
                            'Success',
                            'Uploaded Successfully',
                            'success'
                    )
                    }
                });
            }
        });
        $('#dp_form')[0].reset();
    });
</script>



    