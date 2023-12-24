<?php
require_once "includes/dashboard-header.php"; 

?>

<body>
    <style>
        .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.progress {
  width: 100%;
  background-color: #ddd;
  height: 20px;
  border-radius: 5px;
  overflow: hidden;
}

.progress-bar {
  width: 0;
  height: 100%;
  background-color: #4CAF50;
  text-align: center;
  line-height: 20px;
  color: white;
  transition: width 0.3s ease-in-out;
}


    </style>

    <section class="index-wrapper">
        <!-- ================= Nav ================== -->
       <?php require "includes/nav.php"; ?>
       

        <!-- ================= Footer Nav ================== -->
        <?php require "includes/footer-nav.php"; ?>
        <!-- End Footer Nav -->

        <!-- ================= Post here ================== -->
        <div class="post-here d-flex-sb">
            <div class="phd d-flex">
                <div class="phd-img-div"><a href="profile.php"><img src="uploads/<?= $row['image']; ?>"></a></div>
                <input type="text" class="open-create-post" placeholder="What's new <?= $row['lastname']; ?>?">
                
            </div>
             
            <div class="post-action-icons d-flex-sb">
           <!-- <a href="#">
                        <i class="bi bi-search"></i>
               
                        <div class="expand-search-box">
                            <div class="top d-flex-sb">
                                <i class="bi bi-x close-search-box"></i>
                                <h4>Search</h4>
                            </div>
                            <div class="search-bar d-flex-sb">
                                <i class="bi bi-search"></i>
                                <input type="text" placeholder="Search...">
                            </div>
                            <br>
                          
                        </div>
                        
                    </a> -->
              <!--  <i class="bi bi-arrows-fullscreen open-create-post"></i> -->
                <!-- Expand Create Post -->
                <div class="expand-create-post">
                    <div class="d-flex">
                        <i class="bi bi-x close-create-post mt-0 pt-0"></i>
                        <h3 style="padding-left: 7rem; padding-top: 0; margin-top: 1rem; margin-bottom: 4rem;">Create post</h3>
                    </div>
                    <div class="create-post-inner">
                        <div class="creator-info d-flex">
                            <img src="uploads/<?= $row['image']; ?>">
                            <h4><?= $row['lastname'] . ' ' . $row['firstname']; ?></h4>
                        </div>
                        <div class="post-wrapper">
                           <form id="post_form" method="POST" enctype="multipart/form-data">
                            <hr>
                            <div>
                            <div class="text-center text-danger" id="message">
                        <?php
                        if(isset($error['file'])){
                            echo $error['file'];
                        }
                        ?>
                    </div>
                               <p>Add Image / Video <i class="bi bi-image"></i></p>
                               <input type="file" id="file" name="file" required>  
                            </div>
                            <textarea class="form-control" cols="30" rows="10" name="text" id="text" placeholder="What's new <?= $row['lastname']; ?>?" required></textarea>
                            <input type="submit" class="btn btn-secondary" value="Post">
                          </form>
                        </div>
                        
                    </div>
                    <br />
                   
                    <div id="progress" class="progress" style="display: none;">
                     <div class="progress-bar"></div>
                    </div>




                   </div>
             
                <!-- End Expand Create Post -->
                <!-- <i class="bi bi-send-fill"></i> -->
            </div>
        </div>
        
        <!-- End Post here -->
        <div id="postPopup" class="modal">
        <div class="modal-content">
        
    </div>
    
</div>


        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper">

            
           
            

        </div>
        <!-- End Feeds -->
    </section>

    <script src="moyin_js/jquery2.js"></script>
    <script src="moyin_js/index.js"></script>
</body>

</html>
<script>
    
    $(document).ready(function(){

        $(document).on('click', '.feed-text', function(){
            location.href = 'create-post.php';
        });

            fetch_user();
       

        function fetch_user(){
            $(".loader").fadeOut("show");
            $.ajax({
                url:"backend/fetch-post.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                    $(".loader").fadeOut("slow");
                }
            });
        } 



       
    });
   </script>
<script>
$(document).ready(function(){
    $('#post_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var fileSize = $('#file')[0].files[0].size;
        var maxSize = 5000000000;
        if(fileSize > maxSize){
            $('#message').html('Image size is too large');
        } else {
            $('#progress').show(); // Show the progress bar
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'backend/post.php');
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    var percent = Math.round((e.loaded / e.total) * 100);
                    // Update progress percentage
                    $('#progress').width(percent + '%').text(percent + '%');
                }
            }, false);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        openPostPopup(xhr.responseText);
                    } else {
                        console.log('Error posting:', xhr.statusText);
                    }
                }
            };
            xhr.send(formData);
        }
    });

    function openPostPopup(postId) {
        // Make an AJAX request to fetch post content
        $.ajax({
            url: 'backend/get_post.php',
            type: 'GET',
            data: { post_id: postId },
            success: function(response) {
                // Set the fetched post content in the pop-up
                $('.modal-content').html(response);

                // Display the pop-up modal
                $('#postPopup').show();

                // Close the pop-up modal when the close button is clicked
                $('.close').on('click', function() {
                    $('#postPopup').hide();
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.log('Error fetching post content:', error);
            }
        });
    }
});

</script>