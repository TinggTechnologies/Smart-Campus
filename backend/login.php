<?php
require_once "database/connection.php";

$error = [];

if(isset($_POST['login-btn'])){
    
    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    if(empty($email) || empty($password)){
        $error['err_msg'] = "<div class='alert alert-danger'>Fill in all the fields</div>";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();

        if(password_verify(@$password, @$staff['password'])){
            $_SESSION['id'] = $staff['user_id'];
            $_SESSION['firstname'] = $staff['firstname'];
            $_SESSION['lastname'] = $staff['lastname'];
            $_SESSION['email'] = $staff['email'];
            $_SESSION['telephone'] = $staff['telephone'];
            $_SESSION['code'] = $staff['code'];
            header("location: dashboard.php");
            exit();
        } else{
            $error['err_msg'] = "<div class='alert alert-danger'>Wrong Username or Password</div>";
        }
    }

    
}