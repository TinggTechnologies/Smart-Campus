<?php
session_start();

require_once "./database/connection.php";
if(isset($_SESSION["id"])){
$id = $_SESSION["id"]; 
}

if(isset($_POST) == true){
    $fileName = time().'_'.basename($_FILES["file"]["name"]);
    
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . $fileName;

    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    
    if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetDir)){
            $sql = "INSERT INTO users(image, user_id) VALUES(?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $targetFilePath, $id);
            if($stmt->execute()){
                $_SESSION['image'] = $image;
                $response['status'] = 'ok';
            } else {
                $response['status'] = 'err';
            }
        } else {
            $response['status'] = 'type_err';
        }
    }
    echo json_encode($response);

}