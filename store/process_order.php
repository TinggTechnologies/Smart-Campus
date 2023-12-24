<?php
session_start();
$error = [];

require_once "../database/connection.php";

if(isset($_POST['quality']) && isset($_POST['user_id']) && isset($_POST['product_id'])){

    $quality = trim($_POST["quality"]);
    $quality = stripslashes($quality);
    $quality = htmlspecialchars($quality);

    $product_id = trim($_POST["product_id"]); 
    $product_id = stripslashes($product_id);
    $product_id = htmlspecialchars($product_id);

    $id = trim($_POST["user_id"]); 
    $id = stripslashes($id);
    $id = htmlspecialchars($id);
    //$id = bin2hex(random_bytes(4));
    

    $sql = "INSERT INTO orders(quantity, product_id, user_id, order_date, payment_status) VALUES(?,?,?, NOW(), 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $quality, $product_id, $id);
    if($stmt->execute()){
        echo "<script>location.href = 'cart.php';</script>";
    } else {
        echo "error";
    }


} else {
    echo 'error';
}