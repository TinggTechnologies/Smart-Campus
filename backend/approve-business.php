<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';


$sql2 = "SELECT * FROM products WHERE status='pending'";
$stmt2 = $conn->prepare($sql2);
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
        <h3>'.$rowss['item_name'].'</h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#'.$rowss['category'].' #'.$rowss['price'].' #'.$rowss['description'].'</h4>
        <section id="testimonials" class="testimonials">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="./'.$rowss['image'].'" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section> 
        <a href="approve-business2.php?id='.$rowss['id'].'" class="buy-btn">Approve Business</a>
      </div>
    </div><!-- End Pricing Item -->

    
  </div>';

}
    }
}

echo $output;


                