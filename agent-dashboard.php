<?php
require_once "includes/dashboard-header.php"; ?>

<?php
if( $_SESSION['id']){
$id = $_SESSION['id'];
}
?>

<body>

    <section class="container-fluid index-wrapper">
       <?php require_once "includes/agent-nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav-no.php"; ?>
        <!-- End Navigation -->

      
        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper" style="padding-top: 4.5rem;">
        <img src="./assets/img/easylearn/student.jpg" class="form-control" style="height: 25rem;" alt="">
        <h4 style="font-size: 3rem; padding-top: 2rem;">Agent Dashboard</h4>
        <p style="font-size: 1.6rem; line-height: 1.5; margin-top: 2rem; margin-bottom: 3rem;">You are welcome to Easy Learn where we simplify learning by making learning much more easier and learning environment more conducive for learning. With this dashboard you can monitor everything happening on this system. thank you!</p>
        <div class="form-group text-center">
                        <a href="dashboard.php" class="form-control getStarted-btn">Go to Home</a>
                    </div>
       
        <!-- End Feeds -->
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>

   