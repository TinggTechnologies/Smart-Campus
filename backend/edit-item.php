<?php

$error = [];

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }
    if(isset($_SESSION['item_id'])){
        $item_id = $_SESSION['item_id'];
        }



if(isset($_POST['donate-pdf-btn'])){

    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $item_id = $_POST['item_id'];

    $sql = "UPDATE sell SET item_name=?, price=?, category=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $item_name, $price, $category, $item_id);
    if($stmt->execute()){
        echo "<script>location.href ='edit-item-success.php';</script>";
    }


}