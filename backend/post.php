<?php
session_start();
require_once "../database/connection.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    echo "No session";
}

if ($_FILES['file']['error'] > 0) {
    echo 'Error: ' . $_FILES['file']['error'];
} else {
    $text = $_POST['text'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileTemp = $_FILES['file']['tmp_name'];
    $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('file_') . '.' . $fileExt;
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . $fileName;
    $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');
    $allowedVideoTypes = array('video/mp4', 'video/webm', 'video/quicktime');
    $maxSize = 5000000; // 5MB

    if (in_array($fileType, $allowedImageTypes)) {
        // Handle image upload
        if ($fileSize > $maxSize) {
            echo "Image size is too large";
        } else {
            if (move_uploaded_file($fileTemp, $uploadFile)) {
                // Assuming 'post_image' is the column in your database for storing file paths
                $sql = "INSERT INTO post (post_image, user_id, text, post_date) VALUES (?, ?, ?, DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i %p'))";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $uploadFile, $id, $text); // Use $uploadFile
                $stmt->execute();
            } else {
                echo "Failed to upload image";
            }
        }
    } elseif (in_array($fileType, $allowedVideoTypes)) {
        // Handle video upload
        if ($fileSize > $maxSize) {
            echo "Video size is too large";
        } else {
            if (move_uploaded_file($fileTemp, $uploadFile)) {
                // Assuming 'post_image' is the column in your database for storing file paths
                $sql = "INSERT INTO post (post_image, user_id, text, post_date) VALUES (?, ?, ?, DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i %p'))";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $uploadFile, $id, $text); // Use $uploadFile
                $stmt->execute();
            } else {
                echo "Failed to upload video";
            }
        }
    } else {
        echo "Invalid file type";
    }
}
