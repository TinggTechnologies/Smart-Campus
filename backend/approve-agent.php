<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';


$sql3 = "SELECT DISTINCT user_id,house_title,town,house_type,timestamp FROM register_house WHERE status='pending'";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->get_result();
if($result3->num_rows){
    while($row3 = $result3->fetch_assoc()){
        $time = $row3['timestamp'];
        $sql1 = "SELECT * FROM register_house WHERE timestamp='$time' ";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
            $user_id = $row1['user_id'];
            $sql6 = "SELECT * FROM users WHERE user_id='$user_id' ";
            $stmt6 = $conn->prepare($sql6);
            $stmt6->execute();
            $result6 = $stmt6->get_result();
            if($result6->num_rows){
                $row6 = $result6->fetch_assoc();

            }  
        }

    $output .= '
    <div class="row gy-4">

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item">
        <h3>'.$row6['lastname'] . " ".$row6['firstname'] .'</h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#'.$row6['school'].' #'.$row3['town'].' #'.$row1['price'].' #'.$row1['house_type'].'</h4>
        <section id="testimonials" class="testimonials">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="'.$row1['file'].'" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section> 
        <a href="approve-agent2.php?id='.$row1['timestamp'].'" class="buy-btn">Approve Agent</a>
      </div>
    </div><!-- End Pricing Item -->

    
  </div>';

}
    }


echo $output;


                