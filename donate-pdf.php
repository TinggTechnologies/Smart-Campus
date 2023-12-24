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

require "includes/login-header.php";
?>
<style>
    .loader-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        text-align: center;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 15% auto;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<section class="container-fluid login-wrapper pt-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i>
        </a>
                <h2 class="pt-2 text-center" style="font-size: 2rem; line-height: 1.3;">Donate Pdf</h2>
               <!--  <a href="edit-donate-pdf.php" style="color: blue; font-weight: 500; font-size: 1.1rem;">Edit Pdf</a> -->
                <form id="dp_form" class="pt-0 mt-3" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($error['file'])){
                    echo $error['file'];
                }
                ?>
                <p>Help Smart Campus by donating the PDF you have for other students to have access to. You can also monetize your books by adding prices.</p>
                                <div class="input-group mb-5">
                                    <input type="text" name="title" id="course_title" class="form-control" placeholder="Course Title" required>
                                </div>

                                <div class="input-group mb-5">
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" required>
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
                            <div id="loader" class="loader-container">
                               <div class="loader"></div>
                            </div>
                            
                        </div>
                </div>
            </div>
            
            
        </div>
    </section>
    <?php require "includes/login-footer.php"; ?>
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
            var maxSize = 5000000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/donate-pdf.php',
                    type: 'POST',
                    data: formData,         
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Show the loader when the upload starts
                        $('#loader').show();
                    },
                    success: function(response){
                        $('#loader').hide();
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



    