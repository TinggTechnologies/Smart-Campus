<?php require "header.php"; ?>
<script src="../js/jquery2.js"></script>

<?php

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
}

$sql = "SELECT * FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $item_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
        $user_id = $rows['user_id'];
        $item_name = $rows['item_name'];
        $price = $rows['price'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
        
?>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>product Details</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

  <!--================Single Product Area =================-->
  <div class="product_image_area mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="product_img_slide owl-carousel">
            <div class="single_product_img">
              <img src="../<?= $rows['image']; ?>" alt="#" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="single_product_text text-center">
            <h3><?= $item_name; ?></h3>
            <p>
            <?= $rows['description'] ?>
            </p>
            <div class="card_area">
                <div class="product_count_area">
                    <p>Quantity</p>
                    <form id="inputForm">
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement myButton"> <i class="ti-minus"></i></span>
                        <input class="product_count_item input-number" id="quality" name="quality" type="text" value="1" min="0" max="10">
                        <span class="product_count_item number-increment myButton"> <i class="ti-plus"></i></span>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="user_id" id="user_id">
                        <input type="hidden" value="<?php echo $rows['id']; ?>" name="product_id" id="product_id">
                    <p><div id="output" name="price">#<?= $price; ?> </div></p> 
                  
                </div>
              <div class="add_to_cart">
                  <button id="add_to_cart" class="btn_3">add to cart</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <?php
  }
}
}
}

?>
 <script>
    $(document).ready(function(){
      $('.myButton').click(function(e){
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: 'process_quality.php',
          data: $('#inputForm').serialize(),
          success: function(data){
            var price = <?php echo $price; ?>;
            var result = parseFloat(data) * price;
            $('#output').html("#" + result);
          }
        });
      });
    });
  </script>
   <script>
    $(document).ready(function(){
      $('#add_to_cart').click(function(e){
        e.preventDefault();

        var price = $('#output').val();
        var quantity = $('#quality').val();
        var user_id = $('#user_id').val();
        var product_id = $('#product_id').val();

        $.ajax({
          type: 'POST',
          url: 'process_order.php',
          data: $('#inputForm').serialize(),
          success: function(data){
            $('#output').html(data);
          }
        });
      });
    });
  </script>

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
        <script src="../js/jquery2.js"></script>

        <!-- swiper js -->
        <script src="./assets/js/swiper.min.js"></script>
            <!-- swiper js -->
        <script src="./assets/js/mixitup.min.js"></script>
        <script src="./assets/js/jquery.counterup.min.js"></script>
        <script src="./assets/js/waypoints.min.js"></script>


</body>

</html>