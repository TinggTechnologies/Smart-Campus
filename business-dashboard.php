<?php
require_once "includes/dashboard-header.php"; ?>

<body>
    <style>
        .feed{
            margin-top: 2rem;
        }
        .feed-wrapper p{
            font-size: 1.6rem;
            line-height: 1.5;
            padding-top: 3rem;
        }
        h5{
            font-size: 1.6rem;
            line-height: 1.5;
            font-weight: 700;
        }
        h5 span{
            opacity: .7;
        }
        #assignment-pdf{
            background-color: blue;
            padding: 1rem 3rem;
            color: #fff;
            border-radius: 25px;
        }
        .job-wrapper p{
            font-size: 1.7rem;
            line-height: 1.5;
            padding-top: 3rem;
        }
      
    </style>

    <section class="container-fluid index-wrapper" style="margin-bottom: 5rem;">
       <?php require_once "includes/business-nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav-no.php"; ?>
        <!-- End Navigation -->

         <!-- ================= Story ================== -->
         <div class="story-scroller d-flex-sb">
            <div class="feed d-flex align-items-center">
                <div class="feed-text">
                    <h3>Hi, <span style="color: blue;"><?= $_SESSION['lastname']; ?></span></h3>
                </div>
                
            </div>
            
        </div>
        <!-- End Story -->

        <!-- ================= Feeds ================== -->
        <div class="job-wrapper">
          <img src="./assets/img/easylearn/business.jpg" class="form-control" style="height: 30rem;" alt="">
          <p>You are welcome to the Easy Learn Business Dashboard where you can monitor all the activities going on in the system. 
        </p>

        
        </div>


    </section>
</body>

<?php require_once "includes/dashboard-footer.php"; ?>

