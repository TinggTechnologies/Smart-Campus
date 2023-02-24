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
 
// Configure upload directory and allowed file types
$upload_dir = 'uploads'.DIRECTORY_SEPARATOR;
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');
 
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;

// Checks if user sent an empty form
if(!empty(array_filter($_FILES['files']['name']))) {

    // Loop through each file in files[] array
    foreach ($_FILES['files']['tmp_name'] as $key => $value) {
         
        $file_tmpname = $_FILES['files']['tmp_name'][$key];
        $file_name = $_FILES['files']['name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Set upload file path
        $filepath = $upload_dir.$file_name;

        // Check file type is allowed or not
        if(in_array(strtolower($file_ext), $allowed_types)) {

            // Verify file size - 2MB max
            if ($file_size > $maxsize)        
                echo "Error: File size is larger than the allowed limit.";

            // If file with name already exist then append time in
            // front of name of the file to avoid overwriting of file
            if(file_exists($filepath)) {
                $filepath = $upload_dir.time().$file_name;
                 
                if( move_uploaded_file($file_tmpname, $filepath)) {
                    //echo "{$file_name} successfully uploaded <br />";
                    $sql = "INSERT INTO register_house(user_id, file, house_type, house_category, house_title, price_type, price, state, city, town, bedroom, toilet, business_name, business_description, house_feature, video, contact_state, contact_address, contact_phone, whatsapp_number, contact_email, website, facebook, twitter, youtube, instagram, linkedin, agreement, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'pending')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssssssssssssssssssssssssssss', $user_id, $filepath, $house_type, $house_category,$house_title, $price_type, $price, $state, $city, $town, $bedroom, $toilet, $business_name, $business_description, $house_feature, $video, $contact_state, $contact_address, $contact_phone, $whatsapp_number, $contact_email, $website, $facebook, $twitter, $youtube, $instagram, $linkedin, $agreement);
                    if($stmt->execute()){
                        $sql1 = "INSERT INTO notification (user_id, message) VALUES('admin', 'A house Agent just registered with Eazy Learn')";
                        $sql1 = $conn->prepare($sql1);
                        if($sql1->execute()){
                            echo "<script>location.href = 'agent-success.php';</script>";
                        }
                    }

                }
                else {                    
                    echo "Error uploading {$file_name} <br />";
                }
            }
            else {
             
                if( move_uploaded_file($file_tmpname, $filepath)) {
                    //echo "{$file_name} successfully uploaded <br />";
                    $sql = "INSERT INTO register_house(user_id, file, house_type, house_title, price_type, price, state, city, town, bedroom, toilet, business_name, business_description, house_feature, video, contact_state, contact_address, contact_phone, whatsapp_number, contact_email, website, facebook, twitter, youtube, instagram, linkedin, agreement, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'pending')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sssssssssssssssssssssssssss', $user_id, $filepath, $house_type, $house_title, $price_type, $price, $state, $city, $town, $bedroom, $toilet, $business_name, $business_description, $house_feature, $video, $contact_state, $contact_address, $contact_phone, $whatsapp_number, $contact_email, $website, $facebook, $twitter, $youtube, $instagram, $linkedin, $agreement);
                    if($stmt->execute()){
                         $sql1 = "INSERT INTO notification (user_id, message) VALUES('admin', 'A house Agent just registered with Eazy Learn')";
                        $sql1 = $conn->prepare($sql1);
                        if($sql1->execute()){
                            echo "<script>location.href = 'agent-success.php';</script>";
                        }
                    }

                }
                else {                    
                    echo "Error uploading {$file_name} <br />";
                }
            }
        }
        else {
             
            // If file extension not valid
            echo "Error uploading {$file_name} ";
            echo "({$file_ext} file type is not allowed)<br / >";
        }
    }
}

else {
       // If no files selected
       echo "No files selected.";
}
}
}
