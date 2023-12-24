<?php require "header.php"; ?>
<?php
            include "../database/connection.php";

            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
            }
            if(isset($_GET['item_id'])){
              $order_id = $_GET['item_id'];
          }

            $sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
          $firstname = $rows['firstname'];
          $lastname = $rows['lastname'];
          $email = $rows['email'];
          $school = $rows['school'];
        }}}

            ?>

  <!--================Checkout Area =================-->
  <section class="checkout_area mb-5 pb-5">
    <div class="container">
  
        
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <ul class="list">
                <li>
                  <a href="#">Product
                    <span>Total</span>
                  </a>
                </li>
                <li>
                  <a href="#">Firstname
                    <span><?= $firstname; ?></span>
                  </a>
                </li>
                <li>
                  <a href="#">Lastname
                    <span><?= $lastname; ?></span>
                  </a>
                </li>
                <li>
                  <a href="#">Email
                    <span><?= $email; ?></span>
                  </a>
                </li>
                <li>
                  <a href="#">School
                    <span><?= $school; ?></span>
                  </a>
                </li>
                <?php
$output = '';
$sub_total = null;

$sql = "SELECT * FROM orders WHERE order_id=? AND payment_status='pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $order_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
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
        

    $output .= '
    <li>
    <a href="#">'.$rows1['item_name'].'
      <span class="middle">x '.$rows['quantity'].'</span>
      <span class="last">'.$total_price.'</span>
    </a>
  </li>

';

}
    }

echo $output;

?>

              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    <span><?= $sub_total; ?></span>
                  </a>
                </li>
              </ul>
           <form id="paymentForm">
              <a href="../chat2.php?id=<?= $rows1['user_id']; ?>" class="btn_3 mt-5">Message Buyer</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->


  
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


