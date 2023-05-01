<?php require "includes/main-header.php"; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center text-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-center">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up">Select a Project Topic</h2>
          <p data-aos="fade-up" data-aos-delay="100">Are you a 300 level student from the department of Computer Science of the prestigious Federal University of Oye-Ekiti and you are finding it hard to get a project topic.</p>

          <div class="d-flex form pb-5 align-items-center justify-content-center mb-3" data-aos="fade-up" data-aos-delay="200">
            <a href="#projects" class="btn get-a-quote">Get a Project Topic</a>
        
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
          <span>Project Topics</span>
          <h2>Project Topics</h2>

        </div>

        <div class="row gy-4 align-items-center features-item justify-content-between" id="projects" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/easylearn/ml.PNG" class="img-fluid" alt="">
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <h3>Machine Learning</h3>
            <p>
            <ol>
                <li>Sentiment Analysis</li>
                <li>Fraud Detection</li>
                <li>Stock Market Prediction</li>
                <li>Customer Churn Prediction</li>
                <li>Natural Language Processing</li>
                <li>Speech Recognition</li>
                <li>Music Genre Classification</li>
                <li>Health Diagnosis</li>
                <li>Object Detection</li>
                <li>Traffic Prediction</li>
                <li>Text Summarization</li>
                <li>Language Translation</li>
                <li>Facial Recognition</li>
                <li>Price Prediction</li>
                <li>Handwriting Recognition</li>
                <li>Video Recommendation</li>
                <li>Spam Detection</li>
                <li>Medical Image Analysis</li>
                <li>Object Tracking</li>
                <li>Image Capturing</li>
                <li>Emotion detection</li>
                <li>Sales Prediction</li>
                <li>Video Summarization</li>
            </ol>
            </p>
            <div class="mt-4">
            <a href="#" class="my-btn" style="border-radius: 25px; padding: .7rem 3rem;">Get your project done</a>
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