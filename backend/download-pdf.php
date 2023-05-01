<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';


$sql = "SELECT * FROM tutorial WHERE course_title LIKE '%{$_POST['query']}%' AND status='active'";
$stmt = $conn->prepare($sql);
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
    <div style="margin-top: 3rem;">
    <div class="col-md-4">
    <div class="teacher">
      <div class="teacher-img">
        <img src="uploads/'.$row1['image'].'">
      </div>
      <div class="teacher-info">
        <h3>'.$name.'</h3>
        <p>'.$row['course_title'].'</p>
        <p>'.$row['amount'].'</p>
        <a href="buy-book.php?item_id='.$row['tutorial_id'].'" class="btn enroll-btn" style="background: blue; color: #fff; font-weight: 700;">Buy Course</a>
      </div>
    </div>
  </div>
    </div>
    ' ;
}
} else {
    $output .= '
    
    
    <body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form text-center">
          
                <h2 class="pt-5" style="font-size: 7rem; line-height: 1.3;"><i class="bi bi-x-circle-fill text-danger"></i></h2> 
                <span style="font-size: 1.8rem;">No Tutorial    </span>     
              
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
    
    
    ';
}




        echo $output;