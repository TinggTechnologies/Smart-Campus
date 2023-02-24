<?php require "includes/main-header.php"; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up">Hi, Easy Learners</h2>
          <p data-aos="fade-up" data-aos-delay="100">Welcome to Eazy Learn, the ultimate solution to stress-free schooling! At Eazy Learn, we believe that learning should be an enjoyable experience, and that's why we've created a platform that is designed to make the schooling environment more conducive for students.</p>

          <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" class="form-control" placeholder="Enter school name">
            <button type="submit" class="btn btn-primary get-a-quote">Search</button>
          </form>

          <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

            <?php
include "./database/connection.php";
$sql2 = "SELECT * FROM register_teachers WHERE status='active'";
$stmt2 = $conn->prepare($sql2);
if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    $count_teacher = $result2->num_rows;
}

$sql = "SELECT distinct timestamp FROM register_house WHERE status='active'";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    $count_agent = $result->num_rows;
}

$sql4 = "SELECT * FROM register_business WHERE status='active'";
$stmt4 = $conn->prepare($sql4);
if($stmt4->execute()){
    $result4 = $stmt4->get_result();
    $count_business = $result4->num_rows;
}
  
            ?>

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="<?= $count_teacher; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Teachers</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="<?= $count_agent; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Agents</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="<?= $count_business; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Business</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                <p>Transport</p>
              </div>
            </div><!-- End Stats Item -->

          </div>
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="assets/img/easylearn/intro1.2.jpg" style="border-radius: 5px;" class="img-fluid mb-3 mb-lg-0" alt="">
        </div>

      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

 <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

      <div class="section-header mt-5">
          <span>Hostel Finder</span>
          <h2>Hostel Finder</h2>

        </div>

        <div class="row gy-4">
          <?php

          
$sql3 = "SELECT DISTINCT user_id,house_title,town,house_type,timestamp FROM register_house WHERE status='active' limit 3 ";
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

        ?>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
              <h3><?= $row1['house_title']; ?></h3>
              <h5>School: <?= $row6['school']; ?></h5>
              <h4><sup>N</sup><?= $row1['price']; ?><span> / Year</span></h4>
              <section id="testimonials" class="testimonials">
      <div class="container position-relative" data-aos="fade-up">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="<?= $row1['file']; ?>" class="testimonial-img" alt="">                 
              </div>
            </div>
  
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section> 
              <a href="intro.php" class="buy-btn">Rent Now</a>
            </div>
          </div><!-- End Pricing Item -->

          <?php
          }}
          ?>

         
    <section id="features" class="features pt-3">
      <div class="container">

           
        <div class="section-header mt-5">
          <span>Features</span>
          <h2>Features</h2>

        </div>

        <div class="row gy-4 align-items-center features-item justify-content-between" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/easylearn/hostel.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <h3>Hostel Finder</h3>
            <p class="fst-italic">
             Eazy Learn's hostel finder is a valuable feature that provides students with a convenient and reliable way to find suitable accomodation near their schools. With this feature, Students can focus on their studies and academic persuits, knowing that their accomodation needs are taken care of.
            </p>
            <div class="mt-4">
            <a href="intro.php" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Find a Hostel</a>
            </div>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item justify-content-between" data-aos="fade-up">
          <div class="col-md-5">
            <img src="assets/img/easylearn/group.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-6">
            <h3>Assignment Solver</h3>
            <p>It is time to get the support of highly qualified assignment helpers on Eazy Learn. Are you feeling overwhelmed with your assignment? Don't panic. Register with us and get a well written assignment before your deadline.</p>
            <div class="mt-4">
            <a href="intro.php" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Assignment Solver</a>
            </div>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item justify-content-between" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/easylearn/girls.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <h3>Room Mate Finder</h3>
            <p class="fst-italic">
             Eazy Learn's Roommate Finder is an easy-to-use platform that allows students to create a profile, specify their preferences, and connect with potential roommates who share similar interests and lifestyles. Students can browse through other Profiles and find potential roommates who match their criteria.
            </p>
            <div class="mt-4">
            <a href="intro.php" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Find a Room Mate</a>
            </div>
          </div>
        </div><!-- Features Item -->

      </div>
      
    </section><!-- End Features Section -->

    <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing mt-0 pt-0">
      <div class="container" data-aos="fade-up">

      <div class="section-header mt-5">
          <span>Room Mate Finder</span>
          <h2>Room Mate Finder

        </div>
        <?php

      $sql2 = "SELECT * FROM roommate_finder LIMIT 3";
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

    ?>
    <div class="row gy-4">

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="pricing-item">
        <h3><?= $name; ?></h3>
        <h4 style="font-size: 1.3rem; color: rgba(0,0,0,.6);">#<?= $rowss['age_range'].' #'.$rowss['gender'].' #'.$rowss['department'].' #'.$rowss['religion'].' #'.$rowss['level'].' #'.$row3['school']; ?></h4>
        <p><?= $rowss['bio_data']; ?></p>
        <section id="testimonials" class="testimonials">
<div class="container position-relative" data-aos="fade-up">

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="<?= $rowss['selfie']; ?>" style="border-radius: 25px;" class="testimonial-img" alt="">                 
        </div>
      </div>
      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section> 
        <a href="intro.php" class="buy-btn">Connect</a>
      </div>
    </div><!-- End Pricing Item -->

    
  </div>
  <?php
        }}}
        ?>

      </div>
    </section><!-- End Pricing Section -->

     <!-- ======= Services Section ======= -->
     <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Join Team</span>
          <h2>Join Team</h2>

        </div>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/easylearn/teacher.jpg" alt="" class="img-fluid">
              </div>
              <h3><a href="intro.php" class="stretched-link">Teacher</a></h3>
              <p>Do you have passion for teaching and writing? Easy Learn connects you to different students to help them solve assignments, create a course and sell it to them, and also help students do their projects.<br /><br />
                <a href="intro.php" class="register_btn">Register Here</a>
              </p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/easylearn/business.jpg" alt="" class="img-fluid">
              </div>
              <h3><a href="intro.php" class="stretched-link">Promote Business</a></h3>
              <p>Are you into any business and you want other students to know you better by patronizing you? We are here for you. You register your business with us and you upload the images of what you sell and we connect you to different students to buy what you sell.<br /><br />
                <a href="intro.php" class="register_btn">Register Here</a>
              </p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/easylearn/landlord.jpg" alt="" class="img-fluid">
              </div>
              <h3><a href="intro.php" class="stretched-link">Landlord / Agent</a></h3>
              <p>Are you a Landlord or an Agent and you want Students all over the world to find your house? register with us and students can easily buy, lease or rent your house. <br /><br />
                <a href="intro.php" class="register_btn">Register Here</a>
              </p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/easylearn/driver.jpg" alt="" class="img-fluid">
              </div>
              <h3><a href="intro.php" class="stretched-link">Cab / Bike Driver</a></h3>
              <p>Student queue waiting for a Cab or a Bike man, We want to ensure Students get to school early enough. So if you are a Cab man or Bike man register with us and get paid for carrying students to their destination.<br /><br />
                <a href="intro.php" class="register_btn">Register Here</a></p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/easylearn/watchman.jpg" alt="" class="img-fluid">
              </div>
              <h3><a href="intro.php" class="stretched-link">Easy Learn Agent</a></h3>
              <p>We want to make sure that everything go as planned, We can't be at all places at the same time so we need students at strategic places who can act as a watch man by making sure the houses are legit, drivers are legit, schools are legit etc.. <br /><br />
                <a href="intro.php" class="register_btn">Register Here</a></p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Pricing Section ======= -->

    <!--
    <section id="pricing" class="pricing pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Pricing</span>
          <h2>Pricing</h2>

        </div>

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Free Plan</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="pricing-item featured">
              <h3>Business Plan</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="pricing-item">
              <h3>Developer Plan</h3>
              <h4><sup>$</sup>49<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div>

        </div>

      </div>
    </section>

   
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Frequently Asked Questions</span>
          <h2>Frequently Asked Questions</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-10">

            <div class="accordion accordion-flush" id="faqlist">

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    <i class="bi bi-question-circle question-icon"></i>
                    Non consectetur a erat nam at lectus urna duis?
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    <i class="bi bi-question-circle question-icon"></i>
                    Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                  </button>
                </h3>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    <i class="bi bi-question-circle question-icon"></i>
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                  </button>
                </h3>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                    <i class="bi bi-question-circle question-icon"></i>
                    Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                  </button>
                </h3>
                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    <i class="bi bi-question-circle question-icon"></i>
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                    <i class="bi bi-question-circle question-icon"></i>
                    Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                  </button>
                </h3>
                <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section> -->

  </main><!-- End #main -->

 <?php require "includes/main-footer.php"; ?>