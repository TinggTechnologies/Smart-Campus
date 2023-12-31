<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "includes/login-header.php"; 

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

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Past Question</a>
                <h2 class="pt-5 pb-3" style="font-size: 2rem; line-height: 1.3;">Upload Past Question</h2>
                <p style="font-weight: 500; font-size: 1rem;">You are only allowed to post the past questions of your department and school. for e.g if you are from Computer Science and from the Federal University Oye-Ekiti, you can only post the past questions of the department of Computer Science and the prestigious school only. <br /><br />
            Now concerning the file upload, it is advisable to upload the past questions of all the levels of your department because if another student should do that it will have more chances of being approved.
            <br /><br />
            Now concerning pricing, it is advisable to put a pricing of #500 if you have uploaded all the levels past questions and #200 if you uploaded some levels past questions.
            </p>
                <form id="pq_form" method="POST" enctype="multipart/form-data">
               <div class="message"></div>

                    <div class="input-group mb-4">
                       <textarea id="course_title" name="course_title" class="form-control" placeholder="Enter Course Title" required></textarea>
                    </div>
                    <input type="hidden" name="department" value="<?= $row['department']; ?>">
  
                    <label for="">Past Question File</label>
                    <div class="input-group mb-4">
                       <input type="file" id="file" name="file" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
                    </div>
                    <label for="">Enter 0 if it is free</label>
                    <div class="input-group mb-4">
                    <input type="tel" id="price" name="price" class="form-control" placeholder="Enter Price" required>
                    </div>
                    <div class="input-group mb-4">
                    <textarea name="desc" id="desc" placeholder="Enter the description of the past question" style="width: 100%; height: 10rem;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="pq-btn" id="p_btn" class="form-control getStarted-btn">Continue</button>
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
<script>
    $(document).ready(function(){
        $('#pq_form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var fileSize = $('#file')[0].files[0].size;
            var maxSize = 5000000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/upload-pq.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Show the loader when the upload starts
                        $('#loader').show();
                    },
                    success: function(response) {
                        // Hide the loader when the upload is complete
                        $('#loader').hide();
                        $('#message').html(response);
                        Swal.fire(
                            'Success',
                            'Uploaded Successfully',
                            'success'
        );
    }
});

            }
        });
        $('#pq_form')[0].reset();
    });
</script>


