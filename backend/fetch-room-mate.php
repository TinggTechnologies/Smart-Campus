<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $school = $row['school'];
    }}

$sql1 = "SELECT * FROM roommate_finder WHERE user_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('s', $id);
if($stmt1->execute()){
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
        $rows = $result1->fetch_assoc();
        $department = $rows['department'];
        $level = $rows['level'];
        $age = $rows['age_range'];
        $gender = $rows['gender'];
        $religion = $rows['religion'];
    }}

$sql2 = "SELECT * FROM roommate_finder WHERE (department=? OR level=? OR age_range=? OR gender=? OR religion=?) And user_id !=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('ssssss', $department, $level, $age, $gender, $religion, $id);
if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
        while($rowss = $result2->fetch_assoc()){
            $sql3 = "SELECT * FROM users WHERE user_id=?";
$stmt3 = $conn->prepare($sql3);
$yid = $rowss['user_id'];
$stmt3->bind_param('s', $yid);
if($stmt3->execute()){
    $result3 = $stmt3->get_result();
    if($result3->num_rows > 0){
        $row3 = $result3->fetch_assoc();
        $name = $row3['lastname'] . " " . $row3['firstname'];
    }}

    $output .= '
    <div class="row gy-4">

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item">
        <h3>'.$name.'</h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#'.$rowss['age_range'].' #'.$rowss['gender'].' #'.$rowss['department'].' #'.$rowss['religion'].' #'.$rowss['level'].' #'.$row3['school'].'</h4>
        <p>'.$rowss['bio_data'].'</p>
        <section id="testimonials" class="testimonials">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="'.$rowss['selfie'].'" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section> 
        <a href="connect-roomie.php?id='.$yid.'" class="buy-btn">Connect</a>
      </div>
    </div><!-- End Pricing Item -->

    
  </div>';

}
    }
}

echo $output;


                