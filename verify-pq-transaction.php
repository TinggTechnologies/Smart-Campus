<?php
session_start();
require "database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
if(isset($_GET['pq_id'])){
    $item_id = $_GET['pq_id'];
}

$sql = "SELECT * FROM users WHERE user_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('s', $id);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
              }

           

if(isset($_GET['reference'])){
    $ref = $_GET['reference'];
}
if($ref == ""){
    echo "<script>location.href = 'javascript://history.go(-1)';</script>";
}

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_1654a956a101f80a62752ac1d6053f1cee359bc0",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $result = json_decode($response);
  }

  if($result->data->status == "success"){
    $status = $result->data->status;
    $reference = $result->data->reference;
    $amount = $result->data->amount;
    $transfer_date = $result->data->paid_at;
    date_default_timezone_set('Africa/Lagos');
    $date_time = date('m/d/y h:i:s a', time());
    $category = "past question";

    $sql1 = "INSERT INTO payment (user_id, transfer_amount, transfer_date, status, reference, date, category, verified, page_id) VALUES(?,?,?,?,?,?,?, '1', ?)";
    $sql1 = $conn->prepare($sql1);
    $sql1->bind_param('ssssssss', $id, $amount, $transfer_date, $status, $reference, $date_time, $category, $item_id);
    if($sql1->execute()){

        echo '<script>location.href = "payment-success.php?status='.$reference.'";</script>';
    }

  } else {
    echo "<script>location.href = 'error.php';</script>";
  }
?>