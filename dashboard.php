<?php
require_once "includes/dashboard-header.php"; 

?>


<body>



    <section class="dashboard-wrapper" style="padding-top: 7rem;">
       <?php require_once "includes/nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav.php"; ?>
        <!-- End Navigation -->

        
      <div class="message"></div>
        <!-- ================= Feeds ================== -->
        <div class="profile-header">
            <img src="uploads/<?= $row['image']; ?>" alt="">
            <span class="feed-text">What do you want to share?</span>
            <a href="./friends.php"><i class="bi bi-person-square"></i></a>
        </div>
        <div class="feed-wrapper" style="padding-bottom: 5rem; padding-top: 1rem;">
 
        <!-- End Feeds -->
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>

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
