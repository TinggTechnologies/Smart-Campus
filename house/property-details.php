<?php 
require "header.php"; 
require "nav.php";
?>
<?php

if(isset($_GET['time'])){
  $time = $_GET['time'];
}
if(isset($_SESSION['id'])){
  $id = $_SESSION['id'];
}


$sql1 = "SELECT * FROM register_house WHERE timestamp='$time'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
    $row1 = $result1->fetch_assoc();
    $user_id = $row1['user_id'];

    $sql4 = "INSERT INTO visitors_clicks(visitor_id, owner_id, feature) VALUES(?,?,'hostel')";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param('ss', $user_id, $id);
        if($stmt4->execute()){
            $sql5 = "SELECT * FROM users WHERE user_id='$user_id'";
            $stmt5 = $conn->prepare($sql5);
            $stmt5->execute();
            $result5 = $stmt5->get_result();
            if($result5->num_rows > 0){
              $row5 = $result5->fetch_assoc();
              }  }
}

?>
    <!-- Property Details Section Begin -->
    <section class="property-details-section">
        <div class="property-pic-slider owl-carousel">
            <div class="ps-item">
                <div class="container-fluid">
                    <div class="row">
                    <?php

$sql = "SELECT DISTINCT user_id,house_title,town,house_type,file,timestamp FROM register_house WHERE timestamp='$time' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $file = $row['file'];
          // Check file extension to determine if it's a video or image
          $file_extension = pathinfo($file, PATHINFO_EXTENSION);
          if (in_array(strtolower($file_extension), ['mp4', 'avi', 'mov'])) {
?>
                        
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="ps-item-inner set-bg">
                                    <video width="100%" controls>
                                        <source src="../<?=  $file; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <?php
                    } elseif (in_array(strtolower($file_extension), ['jpg', 'png', 'jpeg', 'gif'])) {
                        ?>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="ps-item-inner set-bg">
                                    <img src="../<?=$row['file']; ?>" style="width: 100%;" />
                                    </div>
                                </div>
                               
                            </div>
                        </div>
    <?php
    }}}
    ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="pd-text">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="pd-title">
                                   
                                    <div class="label">For <?= $row1['house_type'] ?></div>
                                    <div class="pt-price">#<?= $row1['price'] ?><span>/year</span></div>
                                    <h3><?= $row1['house_title'] ?></h3>
                                    <p><span class="icon_pin_alt"></span> <?= $row1['town'] ?></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="pd-board">
                            <div class="tab-board">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Description</a>
                                    </li>
                               
                                </ul><!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="tab-details">
                                            <ul class="left-table">
                                                <li>
                                                    <span class="type-name">Property Type</span>
                                                    <span class="type-value"><?= $row1['house_type'] ?></span>
                                                </li>
                                            
                                                <li>
                                                    <span class="type-name">Price</span>
                                                    <span class="type-value"># <?= $row1['price'] ?>/year</span>
                                                </li>
                                                
                                                <li>
                                                    <span class="type-name">Agent</span>
                                                    <span class="type-value"><?=  $row5['lastname'] .' '. $row5['firstname']; ?></span>
                                                </li>
                                            </ul>
                                            <ul class="right-table">
                                             
                                                <li>
                                                    <span class="type-name">Bedrooms</span>
                                                    <span class="type-value"><?= $row1['bedroom']; ?></span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Bathrooms</span>
                                                    <span class="type-value"><?= $row1['toilet']; ?></span>
                                                </li>
                                   
                                            
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <div class="tab-desc">
                                            <p><?= $row1['house_feature']; ?>.</p>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="pd-widget">
                            <h4>Agent</h4>
                            <div class="pd-agent">
                                <div class="agent-pic">
                                    <img src="../uploads/<?= $row5['image']; ?>" alt="">
                                </div>
                                <div class="agent-text">
                                    <div class="at-title">
                                        <h6><?=  $row5['lastname'] .' '. $row5['firstname']; ?></h6>
                                        <span><?= $row5['department']; ?></span>
                                        <a href="../chat-agent.php?id=<?= $row1['user_id']; ?>" class="primary-btn">Chat Agent</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                   <!--     <div class="pd-widget">
                            <h4>02 reviews</h4>
                            <div class="pd-review">
                                <div class="pr-item">
                                    <div class="pr-avatar">
                                        <div class="pr-pic">
                                            <img src="img/property/details/review/review-1.jpg" alt="">
                                        </div>
                                        <div class="pr-text">
                                            <h6>Brandon Kelley</h6>
                                            <span>15 Aug 2017</span>
                                            <div class="pr-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
                                </div>
                                <div class="pr-item">
                                    <div class="pr-avatar">
                                        <div class="pr-pic">
                                            <img src="img/property/details/review/review-2.jpg" alt="">
                                        </div>
                                        <div class="pr-text">
                                            <h6>Matthew Nelson</h6>
                                            <span>15 Aug 2017</span>
                                            <div class="pr-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="pd-widget">
                            <h4>YOur Rating</h4>
                            <form action="#" class="review-form">
                                
                                    <select name="" id="" style="max-width: 100%;">
                                        <option value="">Enter the number of star</option>
                                        <option value="">1 star</option>
                                        <option value="">2 star</option>
                                        <option value="">3 star</option>
                                        <option value="">4 star</option>
                                        <option value="">5 star</option>
                                    </select>
                              
                                <textarea placeholder="Messages"></textarea>
                               
                                <button type="submit" class="site-btn">send messages</button>
                            </form>
                        </div> -->
                    </div>
                </div>
                
                        
                   
            </div>
        </div>
    </section>
    <!-- Property Details Section End -->

    

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