<?php
include "./database/connection.php";

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
$error = [];

if (isset($_POST['house-btn'])) {
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
    $agreement = $_POST['agreement'];

    // Check if video or image file is selected
    if (!empty(array_filter($_FILES['files']['name']))) {
        $upload_dir = 'uploads' . DIRECTORY_SEPARATOR;

        // Supported video and image extensions
        $allowed_video_types = array('mp4', 'avi', 'mov');
        $allowed_image_types = array('jpg', 'png', 'jpeg', 'gif');

        $maxsize = 100 * 1024 * 1024; // 100 MB maximum file size

        foreach ($_FILES['files']['tmp_name'] as $key => $file_tmpname) {
            $file_name = $_FILES['files']['name'][$key];
            $file_filesize = $_FILES['files']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_filepath = $upload_dir . $file_name;

            if (in_array(strtolower($file_ext), $allowed_video_types)) {
                if ($file_filesize > $maxsize) {
                    echo "Error: File size is larger than the allowed limit.";
                } else {
                    if (move_uploaded_file($file_tmpname, $file_filepath)) {
                        // Video uploaded successfully
                        // Handle other data insertions as needed
                        $sql = "INSERT INTO register_house(user_id, file, house_type, house_category, house_title, price_type, price, state, city, town, bedroom, toilet, business_name, business_description, house_feature, contact_state, contact_address, contact_phone, whatsapp_number, contact_email, website, facebook, twitter, youtube, instagram, linkedin, agreement, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'pending')";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('sssssssssssssssssssssssssss', $user_id, $file_filepath, $house_type, $house_category, $house_title, $price_type, $price, $state, $city, $town, $bedroom, $toilet, $business_name, $business_description, $house_feature, $contact_state, $contact_address, $contact_phone, $whatsapp_number, $contact_email, $website, $facebook, $twitter, $youtube, $instagram, $linkedin, $agreement);
                        if ($stmt->execute()) {
                            $sql1 = "INSERT INTO notification (user_id, sender_id, message) VALUES('admin', '$user_id','A house Agent just registered with Smart Campus')";
                            $stmt1 = $conn->prepare($sql1);
                            if ($stmt1->execute()) {
                                echo "<script>location.href = 'agent-success.php';</script>";
                            }
                        }
                    } else {
                        echo "Error uploading video file: $file_name";
                    }
                }
            } elseif (in_array(strtolower($file_ext), $allowed_image_types)) {
                // Handle image upload here, similar to video
                if ($file_filesize > $maxsize) {
                    echo "Error: File size is larger than the allowed limit.";
                } else {
                    if (move_uploaded_file($file_tmpname, $file_filepath)) {
                        $sql = "INSERT INTO register_house(user_id, file, house_type, house_category, house_title, price_type, price, state, city, town, bedroom, toilet, business_name, business_description, house_feature, contact_state, contact_address, contact_phone, whatsapp_number, contact_email, website, facebook, twitter, youtube, instagram, linkedin, agreement, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'pending')";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('sssssssssssssssssssssssssss', $user_id, $file_filepath, $house_type, $house_category, $house_title, $price_type, $price, $state, $city, $town, $bedroom, $toilet, $business_name, $business_description, $house_feature, $contact_state, $contact_address, $contact_phone, $whatsapp_number, $contact_email, $website, $facebook, $twitter, $youtube, $instagram, $linkedin, $agreement);
                if ($stmt->execute()) {
                    $sql1 = "INSERT INTO notification (user_id, sender_id, message) VALUES('admin', '$user_id','A house Agent just registered with Smart Campus')";
                    $stmt1 = $conn->prepare($sql1);
                    if ($stmt1->execute()) {
                        echo "<script>location.href = 'agent-success.php';</script>";
                    }
                }
            } else {
                echo "Unsupported file format: $file_name";
            }
        }
    } else {
        echo "No files selected.";
    }
}}}
?>
