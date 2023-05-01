<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';


        $sql1 = "SELECT * FROM users WHERE user_id != '$id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows > 0){
            while($row1 = $result1->fetch_assoc()){
            $user_id = $row1['user_id'];
            $sql6 = "SELECT * FROM users WHERE user_id='$user_id' ";
            $stmt6 = $conn->prepare($sql6);
            $stmt6->execute();
            $result6 = $stmt6->get_result();
            if($result6->num_rows){
                $row6 = $result6->fetch_assoc();


    $output .= '
    <div class="row gy-4">

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item">
        <h3>'.$row6['lastname'] . " ".$row6['firstname'] .'</h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#'.$row6['school'].' #'.$row6['department'].' #'.$row6['faculty'].' #'.$row6['gender'].'</h4>
        <section id="testimonials" class="testimonials">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="uploads/'.$row6['image'].'" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section> 
        <a href="delete-user.php?id='.$row1['user_id'].'" class="buy-btn">See User</a>
      </div>
    </div><!-- End Pricing Item -->

    
  </div>';

}
    

}  
}

echo $output;


                