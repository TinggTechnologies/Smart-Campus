
<?php require "./pastquestion-header.php"; ?>
<?php

if(isset($_GET['pq_id'])){
    $item_id = $_GET['pq_id'];
}

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$_SESSION['pastquestion_id'] = $item_id;

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

$sql2 = "SELECT * FROM past_question WHERE pastquestion_id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('s', $item_id);
if($stmt2->execute()){
    $result = $stmt2->get_result();
    if($result->num_rows > 0){
        $row2 = $result->fetch_assoc();
        $user_id = $row2['user_id'];
        $course_title = $row2['course_title'];
        $price = $row2['price'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
        
?>

   <!--================Checkout Area =================-->
  <section class="checkout_area mb-5 pb-5">
    <div class="container">
  
        
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-4">
            <div class="order_box">
              <h2 class="text-center">Your Order</h2>
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
                <li>
                 <a href="#">Course title
                   <span class="last"><?= $course_title; ?></span>
                 </a>
                </li>
                <li>
                  <a href="#">Price
                    <span>&#x20A6;<?= $price; ?></span>
                  </a>
                </li>

              </ul>
              <!-- <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    <span><?= $sub_total; ?></span>
                  </a>
                </li>
                <li>
                  <a href="#">Shipping
                    <span>150.00</span>
                  </a>
                </li>
                <li>
                  <a href="#">Total
                    <span><?= $sub_total + 150 ; ?></span>
                  </a>
                </li>
              </ul> -->
          
  <?php
  if($price === 0){
    ?>
    <a href="../download.php?path=uploads/<?= $row2['file']; ?>" class="btn_3" style="margin-top: 1rem;">Download  Pastquestion</a>
    <?php
  } else {
     ?>
 <form id="paymentForm">
              <div class="creat_account">
                <input type="checkbox" id="f-option4" name="selector" />
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a>
              </div>
              <div class="form-group">
    <input type="hidden" id="email-address" value="<?= $email; ?>" required />
  </div>
  <div class="form-group">
    <input type="hidden" value="<?=  $price; ?>" id="amount" required />
  </div>
  <div class="form-group">
    <input type="hidden" id="first-name" value="<?= $firstname; ?>" />
  </div>
  <div class="form-group">
    <input type="hidden" id="last-name" value="<?= $lastname ?>" />
  </div>
              <div style="text-align: center;">
              <button class="btn_3" onclick="payWithPaystack()" type="submit">Proceed to Paypal</button>
              </div>
              <?php
  }?>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->

          <?php
  }
}
}
}

?>

  <?php require "./footer.php"; ?>

<script>
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
const item_id = <?= $item_id; ?>;
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_c7e02b7b329cd65db9fb7a3321b5e2b9093465d6', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      window.location = "http://localhost/easylearn/dashboard.php?transaction=cancel";
      alert('Transaction cancelled.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/easylearn/store/verify_transaction.php?reference=" + response.reference;
    }
  });

  handler.openIframe();
}
</script>
