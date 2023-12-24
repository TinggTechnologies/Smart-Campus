<?php require "header.php"; 
require "nav.php";
?>

<?php

$sql1 = "SELECT DISTINCT timestamp, user_id, business_name FROM register_house";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
    while($row1 = $result1->fetch_assoc()){
        $user_id = $row1['user_id'];
        $sql2 = "SELECT * FROM users WHERE user_id='$user_id'";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows > 0){
          $row2 = $result2->fetch_assoc();
        }

?>

    <!-- Agent Section Begin -->
    <section class="agent-section spad mt-0 pt-0">
        <div class="container">

            <div class="as-slider owl-carousel">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="as-item">
                            <div class="as-pic">
                                <img src="../uploads/<?= $row2['image']; ?>" style="width: 18rem; height: 10rem;" alt="">
                                <div class="rating-point">
                                    4.5
                                </div>
                            </div>
                            <div class="as-text">
                                <div class="at-title">
                                    <h6><?= $row2['lastname'] . ' ' . $row2['firstname']; ?></h6>
                                    <div class="rating-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                                <ul>
                                    <li>Business Name <span><?= $row1['business_name']; ?></span></li>
                                    <li>Email <span><?= $row2['email']; ?></span></li>
                                    <li>Phone <span><?= $row2['telephone']; ?></span></li>
                                </ul>
                                <a href="../friends-profile2.php?user_id=<?= $row2['user_id']; ?>" class="primary-btn">View profile</a>
                            </div>
                        </div>
                    </div>
                   
                 
                    
                    
                </div>
            </div>


            <?php
            
    }
}
?>
        </div>
    </section>
    <!-- Agent Section End -->


    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.richtext.min.js"></script>
    <script src="js/image-uploader.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>