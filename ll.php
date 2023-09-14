<?php

require "database/connection.php";
if(isset($_GET['time'])){
  $time = $_GET['time'];
}
if(isset($_SESSION['id'])){
  $id = $_SESSION['id'];
}



?>
<?php require "includes/dashboard-header.php" ?>

<body>
<form id="paymentForm">
          <div class="form-group">
                <input type="hidden" id="time" value="<?= $time; ?>"/>
            </div>
            <div class="form-group">
                <input type="hidden" id="email-address" value="<?= $_SESSION['email']; ?>" required />
            </div>
            <div class="form-group">
                <input type="hidden" value="2929" id="amount" required />
            </div>
            <a href="ll.php?time=<?= $time; ?>" class="btn btn-primary w-100" onclick="payWithPaystack()" style="border-radius: 25px;">Pay Now</a>
            </form>
          
</body>

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
      window.location = "verify-pq-transaction.php?pq_id=" + <?= $item_id; ?> + "&reference=" + response.reference;
    }
  });

  handler.openIframe();
}
</script>