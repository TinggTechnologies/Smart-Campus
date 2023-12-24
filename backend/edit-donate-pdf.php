<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM tutorial WHERE teacher_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
        $user_id = $row['teacher_id'];
        $sql1 = "SELECT * FROM users WHERE user_id='$user_id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
            $name = $row1['lastname'] . " " . $row1['firstname'];
            $department = $row1['department'];
        }
    $output .= '
    <body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form text-center"  style="border: 2px solid #ccc; padding: 20px; border-radius: 25px;">
          
                <h2 class="pt-5" style="font-size: 3rem; line-height: 1.3;">'.$name.'</h2>
                <span style="font-weight: 400; font-size: 1.7rem;">Course Title: '.$row['course_title'].'</span><br />
                <span style="font-weight: 400; font-size: 1.7rem;">Description: '.$row['description'].'</span>
                <form id="profile_form">                         
                    <div class="form-group">
                        <a href="edit-single-dp.php?dp_id='.$row['tutorial_id'].'" i style="padding: 1rem 3rem; color: blue;" class="getStarted-btn">Edit Donate Pdf</a>
                    </div>
                </form>
               
            </div><hr>
                </div>
            </div>
           
        </div>
    </section>
    ' ;
}
} else {
    $output .= '
    
    <body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
          
                <h2 class="pt-5" style="font-size: 3rem; line-height: 1.3;">No Pdf</h2>              
               
            </div>
                </div>
            </div>
           
        </div>
    </section>


    ';
}




        echo $output;