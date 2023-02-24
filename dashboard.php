<?php
require_once "includes/dashboard-header.php"; 
//require "backend/functions.php";

?>


<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem;">
       <?php require_once "includes/nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav.php"; ?>
        <!-- End Navigation -->

        <!-- ================= Story ================== -->
        <div class="story-scroller d-flex-sb">
            <div class="feed d-flex align-items-center">
                <a href="./profile.php"> <img src="uploads/<?= $row['image']; ?>" alt="Profile Picture"> </a>
                <div class="feed-text">
                    <h3><?= $_SESSION['lastname'] . " " . $_SESSION['firstname']; ?></h3>
                    <p>Share your thoughts</p><?php /* if(is_user_online($row['user_id'])){ ?>
Online
                 <?php   }else {
                    echo "offline";
                 }  */?>
                    <a href="friends.php" class="getStarted-btn">Discover Peers</a>
                    
                </div>
                
            </div>
            
        </div>
        <!-- End Story -->

        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper" style="padding-top: 3.5rem;">

       
        <!-- End Feeds -->
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>

   <script>
    
    $(document).ready(function(){
    
        fetch_user();

        $(document).on('click', '.feed-text', function(){
            location.href = 'create-post.php';
        });

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-post.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                }
            });
        }

       
    });
   </script>
