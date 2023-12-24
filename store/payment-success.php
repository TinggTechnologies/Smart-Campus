
<?php 
require "pastquestion-header.php";

if(isset($_GET['status'])){
    $status = $_GET['status'];
}

if(isset($_GET['pastquestion_id'])){
  $pastquestion_id = $_GET['pastquestion_id'];
}         



$sql = "SELECT * FROM past_question WHERE pastquestion_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $pastquestion_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
    }}


?>



<main>

    <div class="container">
    <section class="section pt-5 mt-5 mb-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
        </div>
              <div class="text-center">
              <img src="../assets/img/easylearn/delivery.gif" style="width: 10rem; height: 10rem;border-radius: 50%;" />
              </div>
              <p class="text-center">Dear <span style="color: blue;"><?php echo $row['lastname']; ?>,</span> Your payment was successful and you can download the item below. 
              </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <a href="../download.php?path=uploads/<?= $rows['file']; ?>" class="btn w-100 mt-2" style="background-color: blue; color: #fff; border-radius: 15px;">Download Item</a>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "footer.php"; ?>
