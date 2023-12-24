<?php
require "agent-nav.php";

$count_pq = "";
$sql = "SELECT * FROM past_question WHERE user_id=? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pastquestion_id = $row['pastquestion_id'];
        $sql1 = "SELECT SUM(transfer_amount) AS totalTransferAmount FROM payment WHERE item_id=? AND pay_owner='no' AND category='pastquestion'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $pastquestion_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $count_pq = $row1['TotalTransferAmount'];
        } else {
            $count_pq = "No cash yet";
        }
    }
} else {
    $count_pq = "No uploads";
}



?>

    <style>
        /* Custom CSS for the background */
        .custom-bg {
        background: repeating-linear-gradient(45deg, rgba(0, 0, 255, 0.2), rgba(0, 0, 255, 0.2) 10px, rgba(41, 128, 185, 0.2) 10px, rgba(41, 128, 185, 0.2) 20px);
        padding: 0px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>
    <!-- product list part start-->
    <section class="product_list section_padding mt-0 pt-3 mb-0 pb-0" >
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="product_list">
                        <div class="row">
                        <div class="search-result" style="width: 100%;"></div>
    
                            
    <div class="best-product-area lf-padding" style="width: 100%; margin-bottom: 1rem;">
        <div class="product-wrapper bg-height custom-bg">
            <div class="container position-relative">
                <div class="row justify-content-between align-items-end">
                    <div class="product-man position-absolute d-none d-lg-block">
                        <img src="assets/img/categori/card-man.png" alt="">
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                        <div class="vertical-text">
                            <span>Smartcampus</span>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="best-product-caption text-center">
                            <h2>Past Question</h2>
                            <p><?= $count_pq; ?></p>
                            <a href="../chat-agent.php?id=admin" class="btn btn-primary">Chat Admin</a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    </div>

            </div>
        </div>
    </section>
    <!-- product list part end-->

     <!-- product list part start-->
     <section class="product_list section_padding mt-0 pt-3 mb-0 pb-0">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="product_list">
                        <div class="row">
                        <div class="search-result" style="width: 100%;"></div>
    
                            
    <div class="best-product-area lf-padding" style="width: 100%; margin-bottom: 1rem;">
        <div class="product-wrapper bg-height custom-bg">
            <div class="container position-relative">
                <div class="row justify-content-between align-items-end">
                    <div class="product-man position-absolute d-none d-lg-block">
                        <img src="assets/img/categori/card-man.png" alt="">
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                        <div class="vertical-text">
                            <span>Smartcampus</span>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="best-product-caption text-center">
                            <h2>Messages</h2>
                            <p>You can check the messages of those who wants to buy things from you.</p>
                            <a href="../chat-agent-intro.php" class="btn btn-primary">Check Message</a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    </div>

    



            </div>
        </div>
    </section>
    <?php
    $count_tutorial = "";
$sql = "SELECT * FROM tutorial WHERE teacher_id=? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $t_id = $row['tutorial_id'];
        $sql1 = "SELECT * FROM payment WHERE item_id=? AND pay_owner='no' AND category='tutorial'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $t_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $count_tutorial .= $row1['transfer_amount'];
        } else {
            $count_tutorial = "No cash yet";
        }
    }
} else {
    $count_tutorial = "No uploads";
}



?>

     <!-- product list part start-->
     <section class="product_list section_padding mt-0 pt-3 mb-0 pb-0">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="product_list">
                        <div class="row">
                        <div class="search-result" style="width: 100%;"></div>
    
                            
    <div class="best-product-area lf-padding" style="width: 100%; margin-bottom: 1rem;">
        <div class="product-wrapper bg-height custom-bg">
            <div class="container position-relative">
                <div class="row justify-content-between align-items-end">
                    <div class="product-man position-absolute d-none d-lg-block">
                        <img src="assets/img/categori/card-man.png" alt="">
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                        <div class="vertical-text">
                            <span>Smartcampus</span>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="best-product-caption text-center">
                            <h2>Tutorial</h2>
                            <p class="my-0 py-3">&#x20A6;<?= $count_tutorial; ?></p>
                            <a href="../chat-agent.php?id=admin" class="btn btn-primary">Chat Admin</a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    </div>

    



            </div>
        </div>
    </section>
    <!-- product list part end-->


     

<!-- JS here -->
        <!-- All JS Custom Plugins Link Here here -->
     
        <script src="../js/jquery2.js"></script>
        
        <!-- Jquery, Popper, Bootstrap -->

        <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>

        <!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
        <script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
        <script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
        <!-- Jquery Plugins, main Jquery -->    
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>

        <!-- swiper js -->
        <script src="./assets/js/swiper.min.js"></script>
            <!-- swiper js -->
        <script src="./assets/js/mixitup.min.js"></script>
        <script src="./assets/js/jquery.counterup.min.js"></script>
        <script src="./assets/js/waypoints.min.js"></script>
       

</body>

</html>

<script>
    $(document).ready(function(){
      

       $("#search").keyup(function(){
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"../backend/download-past-question.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data){
                    $(".search-result").html(data);
                }
            });

       }
    });
       
    });
   </script>