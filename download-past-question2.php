
<?php require "includes/dashboard-header.php"; ?>
<?php

if(isset($_GET['pq_id'])){
    $item_id = $_GET['pq_id'];
}

$sql = "SELECT * FROM past_question WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $item_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
        $user_id = $rows['user_id'];
        $course_title = $rows['course_title'];
        $price = $rows['price'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
        
?>
<style>
.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
}

.teacher {
  border: 1px solid #ccc;
  padding: 20px;
  margin-bottom: 50px;
  text-align: center;
  position: relative;
}

.teacher-img {
  margin-bottom: 20px;
 
}
.teacher-img img{
    max-width: 100%;
    border-radius: 50%;
    height: 12rem;
}

.teacher-info {
  padding: 10px;
}

.teacher-info h3 {
  margin-top: 0;
}

.teacher-info p {
  margin-bottom: 5px;
}

.enroll-btn {
  position: absolute;
  bottom: -20px;
  left: 50%;
  transform: translateX(-50%);
  transition: all 0.3s ease-in-out;
}

.enroll-btn:hover {
  bottom: -20px;
}

.contact_agent{
  background-color: rgba(0,0,0,.5);
  color: #fff;
}
</style>
<body>
    <?php
     $sql1 = "SELECT * FROM payment WHERE user_id=? AND page_id=?";
     $stmt1 = $conn->prepare($sql1);
     $stmt1->bind_param('ss', $user_id, $item_id);
     $page =$stmt1->execute();
      
         ?>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem; background-color: #fff;">
        <?php require "includes/nav.php"; ?>

        <div class="col-md-4">
      <div class="teacher">
        <div class="teacher-info">
          <h3><?= $course_title; ?></h3>
          <p><?= $row1['school']; ?></p>
          <p class="text-success">#<?= $price; ?></p>
          <?php 

          if($price != 0){
            ?>
            <form id="paymentForm">
            <div class="form-group">
                <input type="hidden" id="email-address" value="<?= $_SESSION['email']; ?>" required />
            </div>
            <div class="form-group">
                <input type="hidden" value="<?=  $price; ?>" id="amount" required />
            </div>
            <button type="submit" class="btn enroll-btn" onclick="payWithPaystack()" style="background: blue; color: #fff; font-weight: 700;">Pay Now</button>
            </form>
             <?php
          } else {
            ?>
            <a href="download.php?path=uploads/<?= $rows['file']; ?>" class="btn enroll-btn" style="background: blue; color: #fff; font-weight: 700;">Download Past Question</a>
            <?php
          }
?>
         
        </div>
      </div>
    </div>

    <div class="card" style="padding-top: 2rem;">
            <div class="card-body">
              <h3 class="card-title text-center" style="padding-bottom: 1rem;">Break Down</h3>

              <!-- Dark Table -->
              <table class="table table-dark table-striped table-hover table-bordered">
                <tbody class="text-center">
                  <tr>
                    <td>Price</td>
                    <td><?= $price; ?></td>
                  </tr>
                  <tr>
                    <td>Availability</td>
                    <td>In Stock</td>
                  </tr>
                  <tr>
                    <td>School</td>
                    <td><?= $row1['school']; ?></td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td>Past Question</td>
                  </tr>
                  <tr>
                    <td>Posted</td>
                    <td><?= $rows['date']; ?></td>
                  </tr>
                </tbody>
              </table>
              <!-- End Dark Table -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">

              <!-- List group with Advanced Contents -->
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" style="background-color: blue; color: #fff;" aria-current="true">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Book Description</h5>
                  </div>
                  
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                  <p class="mb-1"><?= $rows['description'] ?></p>
                </a>
               
              </div><!-- End List group Advanced Content -->

            </div>
          </div>

         


          <?php
  }
}
}
}

?>

  <script src="https://js.paystack.co/v1/inline.js"></script> 
  <?php require "includes/dashboard-footer.php"; ?>

<script>
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_c7e02b7b329cd65db9fb7a3321b5e2b9093465d6', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      window.location = "https://eazylearn.com.ng/home/dashboard.php?transaction=cancel";
      alert('Transaction cancelled.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference ;
      alert(message);
      window.location = "https://eazylearn.com.ng/home/verify-pq-transaction.php?pq_id=" + <?= $item_id; ?> + "&reference=" + response.reference;
    }
  });

  handler.openIframe();
}
</script>