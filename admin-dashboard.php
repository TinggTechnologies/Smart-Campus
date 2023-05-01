<?php
require_once "includes/dashboard-header.php"; ?>

<?php
if( $_SESSION['id']){
$id = $_SESSION['id'];
}
$sql1 = "SELECT * FROM users WHERE user_id='admin'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
        $fetch = $result1->fetch_assoc();
            $status = $fetch['user_id'];
        } 

    if($status !== $id){
        echo '<script>location.href = "dashboard.php";</script>';
    }
?>

<body>

    <section class="container-fluid index-wrapper">
       <?php require_once "includes/admin-nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav.php"; ?>
        <!-- End Navigation -->

      
        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper" style="padding-top: 4.5rem; padding-bottom: 2rem;">
        <img src="./assets/img/easylearn/student.jpg" class="form-control" style="height: 25rem;" alt="">
        <h4 style="font-size: 3rem; padding-top: 2rem;">Admin Dashboard</h4>
        <p style="font-size: 1.6rem; line-height: 1.5; margin-top: 2rem; margin-bottom: 3rem;">You are welcome to Easy Learn where we simplify learning by making learning much more easier and learning environment more conducive for learning. With this dashboard you can monitor everything happening on this system. thank you!</p>
        <?php
$counter_file = "counter.txt";

if(!file_exists($counter_file)){
  echo "No file"; 
} else {
  $counter = file_get_contents($counter_file);
}


echo "Visitors: " . $counter;


?>
        <div class="form-group text-center">
                        <a href="dashboard.php" class="form-control getStarted-btn">Go to Home</a>
                    </div>
       
        <!-- End Feeds -->
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>

   