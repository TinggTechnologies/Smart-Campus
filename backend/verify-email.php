<?php
session_start();
require_once "../database/connection.php";

if(isset($_POST["code"])){

    $password = trim($_POST["code"]);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    $id = trim($_SESSION['id']);
    $id = stripslashes($id);
    $id = htmlspecialchars($id);

   

}