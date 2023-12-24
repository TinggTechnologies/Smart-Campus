<?php require "header.php"; ?>

    <main>

        <!-- slider Area Start -->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height" data-background="assets/img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="assets/img/hero/hero_man.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Market Place</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Let's embark on a journey where We connect you to potential sellers and buyers close to your school.</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="#latest-product-area" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
       
        <!-- Category Area End-->
        <!-- Latest Products Start -->
        <section class="latest-product-area padding-bottom">
            <div class="container">
                <div class="row product-btn d-flex justify-content-end align-items-end">
                    <!-- Section Tittle -->
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="section-tittle mb-30" id="latest-product-area">
                            <h2 class="pt-5">Latest Products</h2>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="properties__button f-right">
                            <!--Nav Button  -->
                            <nav>                                                                                                
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" style="color: blue;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Food</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Drink</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Groceries</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Gadgets</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#accessories" role="tab" aria-controls="nav-contact" aria-selected="false">Accessories</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#wears" role="tab" aria-controls="nav-contact" aria-selected="false">Wears</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#beauty" role="tab" aria-controls="nav-contact" aria-selected="false">Beauty</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#books" role="tab" aria-controls="nav-contact" aria-selected="false">Books</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Food and Snacks' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>"> <img src="../<?= $friendss_row['image']; ?>" alt=""> </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>#<?= $friendss_row['price']; ?></li>
                                        </div>
                                    </div>

                                </div>
               
                            </div>  
                            <?php
                    }}} else {
                      echo "";
                    }
        ?>

                        </div>
                    </div>
                    <!-- Card two -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Drinks' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
        ?>

                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>"> 
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>

                        </div>
                    </div>
                    <!-- Card three -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">

                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Groceries' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                        </div>
                    </div>
                    <!-- card four -->
                    <div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Gadgets' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                    </div>
                </div>
                <!-- End Nav Card -->

                <!-- card four -->
                <div class="tab-pane fade" id="accessories" role="tabpanel" aria-labelledby="nav-last-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Home Accessories' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                    </div>
                </div>
                <!-- End Nav Card -->

                <!-- card four -->
                <div class="tab-pane fade" id="wears" role="tabpanel" aria-labelledby="nav-last-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Wears and Jewelries' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                    </div>
                </div>
                <!-- End Nav Card -->

                 <!-- card four -->
                 <div class="tab-pane fade" id="beauty" role="tabpanel" aria-labelledby="nav-last-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Beaulty and Health' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                    </div>
                </div>
                <!-- End Nav Card -->

                <!-- card four -->
                <div class="tab-pane fade" id="books" role="tabpanel" aria-labelledby="nav-last-tab">
                        <div class="row">
                        <?php 
      
      $sql = "SELECT * FROM products WHERE category='Books' AND status = 'approved'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];  
  
        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                    <a href="single-product.php?item_id=<?= $friendss_row['id']; ?>">
                                        <img src="../uploads/<?= $friendss_row['image']; ?>" alt="">
                                    </a>
                                        <div class="new-product">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#"><?= $friendss_row['item_name']; ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li><?= $friendss_row['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }}} else {
                        echo "";
                      }
          ?>
                    </div>
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
        <!-- Best Product Start -->
        <div class="best-product-area lf-padding text-center" >
           <div class="product-wrapper bg-height" style="background-image: url('assets/img/categori/card.png')">
                <div class="container position-relative">
                    <div class="row justify-content-between align-items-end">
                        <div class="product-man position-absolute  d-none d-lg-block">
                            <img src="assets/img/categori/card-man.png" alt="">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                            <div class="vertical-text">
                                <span>Manz</span>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="best-product-caption">
                                <h2>Meet With Our sellers</h2>
                                <p>Uncover the personalities and stories of our vibrant community of sellers.</p>
                                <a href="#" class="black-btn">Meet sellers</a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <!-- Shape -->
           <div class="shape bounce-animate d-none d-md-block">
               <img src="assets/img/categori/card-shape.png" alt="">
           </div>
        </div>
       
        <!-- Latest Offers Start -->
      <!--  <div class="latest-wrapper lf-padding">
            <div class="latest-area latest-height d-flex align-items-center" data-background="assets/img/collection/latest-offer.png">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 offset-xl-1 offset-lg-1">
                            <div class="latest-caption">
                                <h2>Get Our<br>Latest Offers News</h2>
                                <p>Subscribe news latter</p>
                            </div>
                        </div>
                         <div class="col-xl-5 col-lg-5 col-md-6 ">
                            <div class="latest-subscribe">
                                <form action="#">
                                    <input type="email" placeholder="Your email here">
                                    <button>Shop Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="man-shape">
                    <img src="assets/img/collection/latest-man.png" alt="">
                </div>
            </div>
        </div> -->
       

   
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
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
        
    </body>
</html>