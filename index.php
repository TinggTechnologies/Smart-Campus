<?php require "includes/main-header.php"; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center text-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-center">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up">Welcome to Eazy Learn</h2>
          <p data-aos="fade-up" data-aos-delay="100">The ultimate solution to stress-free schooling hereby giving you an enjoyable learning experience.</p>

          <div class="d-flex form pb-5 align-items-center justify-content-center mb-3" data-aos="fade-up" data-aos-delay="200">
            <a href="intro.php" class="btn get-a-quote">Register</a>
            <a href="login.php" class="btn get-a-quote ms-3">Login</a>
</div>
<?php
$counter_file = "counter.txt";

if(!file_exists($counter_file)){
  $counter = 0;
} else {
  $counter = file_get_contents($counter_file);
}
$counter++;

file_put_contents($counter_file, $counter);



?>
    </div>
  </section><!-- End Hero Section -->
  

  <main id="main">
     
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
            <p>
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
            <p>
             Eazy Learn's Roommate Finder is an easy-to-use platform that allows students to create a profile, specify their preferences, and connect with potential roommates who share similar interests and lifestyles. Students can browse through other Profiles and find potential roommates who match their criteria.
            </p>
            <div class="mt-4">
            <a href="intro.php" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Find a Room Mate</a>
            </div>
          </div>
        </div><!-- Features Item -->

      </div>
      
    </section><!-- End Features Section -->


     <!-- ======= Services Section ======= -->
     <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Start Earning</span>
          <h2>Start Earning</h2>

        </div>

        <div class="row gy-4 align-items-center features-item justify-content-between" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/easylearn/ass.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <h3 style="color: #030f3a; font-weight: 700;">Start Earning as a student</h3>
            <p>
            Eazy Learn provides opportunities for students to make money from what they have passion for. you can get paid for doing the following; freelance tutoring, Business Advertising, Referral Programs, Content Creation, Agency, Transportation, Past question and Tutorial donation etc.
            </p>
            <div class="mt-4">
            <a href="intro.php" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Start Earning</a>
            </div>
          </div>
        </div><!-- Features Item -->

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
-->
   
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
                    What is Eazy Learn Tech?
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Eazy Learn is a platform designed to solve the challenges faced by students in higher institutions in Nigeria. It was created to provide a one-stop solution to most of the challenges students face on a daily basis. The platform offers various features that are tailored to the needs of students in Nigeria, such as Hostel Finder, Room Mate Finder, downloading past questions,downloading tutorials, advertising student businesses, and many more.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    <i class="bi bi-question-circle question-icon"></i>
                    What Problem is Eazy Learn solving in the Educational Sector?
                  </button>
                </h3>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Some of the major challenges faced by students in Nigeria is difficulty in finding a suitable accommodation, especially for students who are not familiar with the location of their institution, difficulty in accessing past questions and tutorials, difficulty in advertising their businessess to other students. We intend solving these problems and more.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    <i class="bi bi-question-circle question-icon"></i>
                    Who brought about the idea?
                  </button>
                </h3>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    ANONYMOUS.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                    <i class="bi bi-question-circle question-icon"></i>
                    Can students make money off Eazy Learn?
                  </button>
                </h3>
                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    <i class="bi bi-question-circle question-icon"></i>
                    Apart from solving issues that students encounter on a regular basis, we intend creating job opportunities for students. So students can register as a teacher, a driver, agent, business owners and start earning.You can also upload PDFs and tutorials to earn too.
                  </div>
                </div>
              </div>


            </div>

          </div>
        </div>

      </div>
    </section> 

  </main><!-- End #main -->

 <?php require "includes/main-footer.php"; ?>