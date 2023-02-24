<?php
session_start();

require_once "../database/connection.php";


    $job = trim($_POST["job"]);
    $job = stripslashes($job);
    $job = htmlspecialchars($job);

    $_SESSION['job'] = $job;