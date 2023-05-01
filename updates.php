<?php require_once "includes/dashboard-header.php"; 
?>
<body>

    <section class="create-post-wrapper">
        <form id="post_form" method="POST" enctype="multipart/form-data">
        <header class="d-flex-sb">
            <a href="javascript:history.back();"><i class="bi bi-chevron-left"></i></a>
            <h2>Send Email</h2>
            <a href="#" class="btn btn-secondary">Send</a>
        </header>
        <div class="create-post-inner">
            <div class="creator-info d-flex">
                <img src="uploads/<?= $row['image']; ?>">
                <h4 style="padding-left: .5rem;"><?= $row['lastname'] . " " . $row['firstname']; ?></h4>
            </div>
            <div class="post-wrapper">
                <hr>
                <div>
                    <div class="text-center text-danger" id="message">
                        <?php
                        if(isset($error['file'])){
                            echo $error['file'];
                        }
                        ?>
                    </div>
                <textarea class="form-control" cols="30" rows="10" name="text" id="text" placeholder="What's on your mind?" required></textarea>
                <input type="submit" class="btn btn-secondary" name="btn" id="btn" value="Send">
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
            var text = $('#text').val;
            if(text = ""){
                $('#message').html('Enter a text');
            } else{
                $.ajax({
                    url: 'backend/updates.php',
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



