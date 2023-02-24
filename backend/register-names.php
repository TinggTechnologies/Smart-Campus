<?php
session_start();
$error = [];

require_once "../database/connection.php";

if(isset($_POST["btn"])){

    $firstname = trim($_POST["firstname"]);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = trim($_POST["lastname"]); 
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $id = trim($_POST["id"]); 
    $id = stripslashes($id);
    $id = htmlspecialchars($id);
    //$id = bin2hex(random_bytes(4));
    

    $sql = "INSERT INTO users(firstname, lastname, user_id) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $firstname, $lastname, $id);
    if($stmt->execute()){
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['id'] = $id;
    } else {
        echo "not registered";
    }


}