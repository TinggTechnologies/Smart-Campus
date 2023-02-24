<?php

include "./database/connection.php";

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    }
    $error = [];
if(isset($_POST['house-btn'])){

    $house_type = $_POST['house_type'];
    $house_category = $_POST['house_category'];
    $house_title = $_POST['house_title'];
    $price_type = $_POST['price_type'];
    $price = $_POST['price'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $bedroom = $_POST['bedroom'];
    $toilet = $_POST['toilet'];
    $business_name = $_POST['business_name'];
    $business_description = $_POST['business_description'];
    $house_feature = $_POST['house_feature'];
    $video = $_POST['video'];
    $contact_state = $_POST['contact_state'];
    $contact_address = $_POST['contact_address'];
    $contact_phone = $_POST['contact_phone'];
    $whatsapp_number = $_POST['whatsapp_number'];
    $contact_email = $_POST['contact_email'];
    $website = $_POST['website'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    @$agreement = $_POST['agreement'];

    if(empty($house_type) || empty($house_category) || empty($house_title) || empty($price_type) || empty($price) || empty($state) || empty($city) || empty($town) || empty($contact_state) || empty($contact_address) || empty($contact_phone) || empty($contact_email)){
        $error['file'] = "<div class='alert alert-danger'>Inputs with Asterik should not be empty</div>";
    } elseif(@$agreement == ""){
        $error['file'] = "<div class='alert alert-danger'>Agreement cannot be empty</div>";
    }

    else {
 
                    $sql = "UPDATE register_house SET user_id=?, file=?, house_type=?, house_category=?, house_title=?, price_type=?, price=?, state=?, city=?, town=?, bedroom=?, toilet=?, business_name=?, business_description=?, house_feature=?, video=?, contact_state=?, contact_address=?, contact_phone=?, whatsapp_number=?, contact_email=?, website=?, facebook=?, twitter=?, youtube=?, instagram=?, linkedin=?, agreement=?, status='pending' WHERE user_id='$user_id' ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssssssssssssssssssssssssssss', $user_id, $filepath, $house_type, $house_category,$house_title, $price_type, $price, $state, $city, $town, $bedroom, $toilet, $business_name, $business_description, $house_feature, $video, $contact_state, $contact_address, $contact_phone, $whatsapp_number, $contact_email, $website, $facebook, $twitter, $youtube, $instagram, $linkedin, $agreement);
                    if($stmt->execute()){
                        echo "<script>location.href = 'agent-success.php';</script>";
                    }

                }
                
}