<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM assigment WHERE student_id=? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
        $user_id = $row['student_id'];
        $sql1 = "SELECT * FROM users WHERE user_id='$user_id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
            $name = $row1['lastname'] . " " . $row1['firstname'];
            $department = $row1['department'];
        }
    ?>
     <style>
        /* Custom CSS for the background */
        .custom-bg {
        background: repeating-linear-gradient(45deg, rgba(0, 0, 255, 0.2), rgba(0, 0, 255, 0.2) 10px, rgba(41, 128, 185, 0.2) 10px, rgba(41, 128, 185, 0.2) 20px);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
      
    </style>
  <section class="container pt-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <div class="card p-4 custom-bg">
                    <h2 class="card-title"><?=$row['course_title']?></h2>
                    <p class="card-text">Department: <?=$department?></p>
                    <p class="card-text">Institution: <?=$row1['school']?></p>
                    <p class="card-text">Title: &#x20A6;<?=$row['course_description']?></p>

                    <form id="profile_form">
                        <div class="form-group">
                            <a href="edit-single-assignment.php?assignment_id=<?=$row['assignment_id']?>" class="btn btn-primary btn-lg">Edit Assignment</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> <br />
    <?php
}
} else {
    $output .= '
    
    <body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
          
                <h2 class="pt-5" style="font-size: 3rem; line-height: 1.3;">No Past Question</h2>              
               
            </div>
                </div>
            </div>
           
        </div>
    </section>


    ';
}




        echo $output;
        ?>
