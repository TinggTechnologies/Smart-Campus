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
    
    $item_id = trim($_POST["item_id"]); 
    $item_id = stripslashes($item_id);
    $item_id = htmlspecialchars($item_id);
    

    $sql = "DELETE FROM orders WHERE order_id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $item_id);
    if($stmt->execute()){
        echo "<script>location.href = 'cart.php';</script>";
    } else {
        echo "error";
    }


} else {
    echo 'error';
}