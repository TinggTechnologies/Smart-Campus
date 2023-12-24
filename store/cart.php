<?php require "header.php"; ?>
    <!--================Cart Area =================-->
    <section class="cart_area section_padding mt-0 pt-0">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
          
<?php

include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';
$sub_total = null;

$sql = "SELECT * FROM orders WHERE user_id=? AND payment_status='pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      ?>   <thead>
      <tr>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Edit</th>
        <th scope="col">Buy</th>
      </tr>
    </thead>
    <?php
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['user_id'];
        $product_id = $rows['product_id'];
        $quantity = $rows['quantity'];
        $sql1 = "SELECT * FROM products WHERE id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $product_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $rows1 = $result1->fetch_assoc(); 
                $total_price = $rows1['price'] * $quantity;
                $sub_total += $total_price;
                }
            }
        

    ?>
            <tbody>
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="../<?= $rows1['image']; ?>" alt="" />
                    </div>
                    <div class="media-body text-center">
                      <p><?= $rows1['item_name']; ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>#<?= $rows1['price']; ?></h5>
                </td>
                <td>
                  <div class="product_count d-flex">
                    <span><?= $rows['quantity']; ?></span>
                  </div>
                </td>
               <td>
                <a style="color: blue;" href="edit-cart.php?item_id=<?= $rows['order_id']; ?>"><i class="fas fa-pencil-alt"></i></a><br />
                <a style="color: red;" href="trash_cart.php?item_id=<?= $rows['order_id']; ?>"><i class="fas fa-trash"></i></a>
                </td>
                <td>
                  <a href="checkout.php?item_id=<?= $rows['order_id']; ?>" class="btn_1">Buy</a>
                </td>
              </tr>
 
              <?php
        }?>   
        
        <tr>
                
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5><?= $sub_total; ?></h5>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-left">
            <a class="btn_1" href="./">Continue Shopping</a>
          </div>
        </div>
      </div>
  </section>
      
      <?php } else {
          ?>
<div style="text-align: center; padding-top: 1rem; color: red; font-size: 1.5rem;">No cart</div>
          <?php
        }}
?>
  <!--================End Cart Area =================-->




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
    
    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

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