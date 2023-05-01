<?php require_once "includes/dashboard-header.php"; 
?>
<body>

    <section class="create-post-wrapper">
        <form id="post_form" method="POST" enctype="multipart/form-data">
        <header>
            <a href="javascript:history.back();"><i class="bi bi-chevron-left left-click"></i></a>
            <h2>Create post</h2>
            <a href="#" class="btn btn-secondary">Post</a>
        </header>
        <div class="create-post-inner" style="padding-top: 1rem;">
            <div class="creator-info d-flex">
                <img src="uploads/<?= $row['image']; ?>">
                <h4 style="padding-left: .5rem;"><?= $row['lastname'] . " " . $row['firstname']; ?></h4>
            </div>
            <div class="post-wrapper">
                
                <div>
                    <div class="text-center text-danger" id="message">
                        <?php
                        if(isset($error['file'])){
                            echo $error['file'];
                        }
                        ?>
                    </div>
                   <p>Add Image <i class="bi bi-image"></i></p>
                    <input type="file" id="file" name="file" required> 
                </div>
                <textarea class="form-control" cols="30" rows="10" name="text" id="text" placeholder="What's on your mind?" required></textarea>
                <input type="submit" class="btn btn-secondary" name="btn" id="btn" value="Post">
            </div>
        </div>
        
        </form>
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>
   <script>
    $(document).ready(function(){
        $('#post_form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var fileSize = $('#file')[0].files[0].size;
            var maxSize = 5000000;
            if(fileSize > maxSize){
                $('#message').html('Image size is too large');
            } else{
                $.ajax({
                    url: 'backend/post.php',
                    type: 'POST',
                    data: formData,         
                    processData: false,
                    contentType: false,
                    success: function(response){
                        $('#message').html(response);
                        location.href = "dashboard.php";
                    }
                });
            }
        });
    });
</script>



