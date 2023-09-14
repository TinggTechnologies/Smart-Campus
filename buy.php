<?php include_once "includes/dashboard-header.php";   ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- link bootstrap css -->
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <!-- link font-->
  <link rel="stylesheet" href="assets/lib/fontawsome/css/all.css">
  <title>Eazy Learn</title>
</head>

<body style="margin-top: 10rem;" >
  <!-- navbar -->

 <!--  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top p-0">
    <div class="container-fluid">
      <a class="navbar-brand py-3" href="dashboard.php">
      <img src="./assets/img/easylearn/logo3.jpg" style="width: 13rem;" alt="">
      </a>


      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#foods">Food & Snacks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#drinks">Drinks</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#Top-Restaurants" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Grocercies
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item fs-2" href="#">Confectionaries</a></li>

            </ul>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gadgets">Gadgets</a>
          </li>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="#home">Home Accesories</a>
          </li>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="#wears">Wears</a>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="#beaut" tabindex="-1" aria-disabled="true">Beauty & Health
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#books" tabindex="-1" aria-disabled="true">Books
            </a>
          </li>
        </ul>

        <form class="d-flex me-4" method="$_POST">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-danger" type="submit">Search</button>
        </form>
      </div>
    </div>

  </nav> -->
  <?php require "includes/nav.php" ?>

  <!-- ************************nav ends ************************************-->



  <!--*********************** hero session/. carousel ********************************************-->
 <!-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active hero-header">
        <div class="container-xxl bg-white py-5 bg-dark hero-header mb-5">
          <div class="container my-5 py-5">
            <div class="row align=items-center g-5">
              <div class="col-lg-6 text-center text-lg-start">
                <h2 class="display-3 text-white animated-slideinLeft">1. Select the Item you want to buy</h2>
                <a href="" class="btn btn-warning py-sm-3 px-sm-5 me-2"></a>
              </div>

              <div class="col-lg-6  text-center text-lg-end overflow-hidden">
                
                <img src="./assets/img/easylearn/shop2.gif" alt="" class="img-fluid img">
              </div>
            </div>
          </div>

        </div>
      </div>

    

      <div class="carousel-item hero-header-two">
        <div class="container-xxl bg-white py-5 bg-dark hero-header-two mb-5">
          <div class="container my-5 py-5">
            <div class="row align=items-center g-5">
              <div class="col-lg-6 text-center text-lg-start">
                <h2 class="display-3 text-white animated-slideinLeft">2. Connect to the seller</h2>
                <a href="" class="btn btn-warning py-sm-3 px-sm-5 me-2"></a>
              </div>

              <div class="col-lg-6  text-center text-lg-end overflow-hidden">
               
                <img src="./assets/img/easylearn/delivery.gif" alt="" class="img-fluid img">
              </div>
            </div>
          </div>

        </div>
      </div>


     
      <div class="carousel-item  hero-header-two">
        <div class="container-xxl bg-white py-5 bg-dark hero-header-two mb-5">
          <div class="container my-5 py-5">
            <div class="row align=items-center g-5">
              <div class="col-lg-6 text-center text-lg-start">
                <h2 class="display-3 text-white animated-slideinLeft">3. And make Purchase from the Seller.</h2>

                <a href="" class="btn btn-warning py-sm-3 px-sm-5 me-2"></a>
              </div>

              <div class="col-lg-6  text-center text-lg-end overflow-hidden">
                
                <img src="./assets/img/easylearn/delivery.gif" alt="" class="img-fluid img">
              </div>
            </div>
          </div>

        </div>
      </div>



      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> -->

    <!-- hero end -->




    <!--************** *Foods ************************* -->
    <h2 class="new text-center fs-1  my-3 py-4 text-white bg-primary mt-5" id="foods">Food & Snacks</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">

      <?php 
      
    $sql = "SELECT * FROM sell WHERE category='Food and Snacks'";
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($friendss_row = $result->fetch_assoc()){
                $fid = $friendss_row['user_id'];
                $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('s', $fid);
                if($stmt1->execute()){
                    $result1 = $stmt1->get_result();
                    if($result1->num_rows > 0){
                        $friends_row = $result1->fetch_assoc();


      ?>

        <div class="col col-6 col-md-4 text-center">
          <div class="card shadow" style="border-radius: 25px;">
            <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
            <div class="card-body">
              <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
              <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
              <h4 style="font-size: 2rem;"></h4>
              <div class="dropdown">
                <a class="btn btn-primary px-5" style="border-radius: 25px;" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" >
                  Order Now
                </a>
              </div>
            </div>
          </div>
        </div>

        <?php
                    }}}} else {
                      echo "no";
                    }}
        ?>
  
        
      </div>
    </div>
 

    <!-- ***********************************ends -->



    <!--********* Drink session -->

    <div class="container py-3 me-4 wraps" id="drinks">
      <h2 class="drink py-4 my-2 text-center bg-primary fs-1">Drinks</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4 my-5 ">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Drinks'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" style="border-radius: 25px;" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" >
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>
      </div>
    </div>

    <!-- ******End drink session -->


    <!-- Groceries************************************************ -->
    <h2 class="new text-center fs-1 py-4 text-white bg-primary" id="groceries">Groceries</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Groceries'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" style="border-radius: 25px;" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" >
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>



      </div>
    </div>
    <!-- Grocercies ends************************************************ -->





    <!-- Groceries************************************************ -->
    <h2 class="new text-center bg-primary fs-1 py-4 text-white" id="gadgets">Gadgets</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Gadgets'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" style="border-radius: 25px;">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>



      </div>
    </div>
    <!-- Grocercies ends************************************************ -->



    <!-- ****HOME ACESSORIES ******************************************** -->
    <h2 class="new text-center bg-primary fs-1 py-4 text-white" id="home">Home Accesories</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Home Accessories'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
                      
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" style="border-radius: 25px;">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
         <?php

                      }}}}}
?>


      </div>
      </div>

        <!-- ****HOME ACESSORIES Ends******************************************** -->









        
        





        <!--**************************************Wears **************************** -->
        <h2 class="new text-center bg-primary fs-1 py-4 text-white" id="wears">Wears and Jewleries</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Wears and Jewelries'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" style="border-radius: 25px;">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>


      </div>
      </div>
     
         
       
            <!--**************************************Wears Ends **************************** -->






            <!--**************************************Wears **************************** -->
        <h2 class="new text-center bg-primary fs-1 py-4 text-white" id="beaut">Beauty & Health</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Beaulty and Health'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" style="border-radius: 25px;">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>


      </div>
      </div>
     
         
       
            <!--**************************************Wears Ends **************************** -->


            <!--**************************************Books **************************** -->
        <h2 class="new text-center bg-primary fs-1 py-4 text-white mb-5" id="books">Books</h2>
    <div class="container py-5 my-4 me-4 wrap">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
      
      $sql = "SELECT * FROM sell WHERE category='Books'";
      $stmt = $conn->prepare($sql);
      if($stmt->execute()){
          $result = $stmt->get_result();
          if($result->num_rows > 0){
              while($friendss_row = $result->fetch_assoc()){
                  $fid = $friendss_row['user_id'];
                  $sql1 = "SELECT * FROM register_business WHERE user_id = ?";
                  $stmt1 = $conn->prepare($sql1);
                  $stmt1->bind_param('s', $fid);
                  if($stmt1->execute()){
                      $result1 = $stmt1->get_result();
                      if($result1->num_rows > 0){
                          $friends_row = $result1->fetch_assoc();
  
  
        ?>
  
          <div class="col col-6 col-md-4 text-center">
            <div class="card shadow" style="border-radius: 25px;">
              <img src="uploads/<?= $friendss_row['image']; ?>" class="card-img-top shadow" alt="..." style="border-radius: 25px;">
              <div class="card-body">
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['item_name']; ?></h3>
                <h3 class="card-title" style="font-size: 1.7rem;"><?= $friendss_row['price']; ?></h3>
                <h4 style="font-size: 2rem;"></h4>
                <div class="dropdown">
                  <a class="btn btn-primary px-5" href="buy-item.php?item_id=<?= $friendss_row['id']; ?>" style="border-radius: 25px;">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <?php
                      }}}} else {
                        echo "no";
                      }}
          ?>


      </div>
      </div>
     
         
       
            <!--**************************************Books Ends **************************** -->
























            <!--************* css  *************************************-->

            <style>
  
              .nav-link {
                font-size: 18px !important;
                color: #A64468 !important;
                margin-left: 12px !important;
              }

              .nav-link:hover {
                color: black !important;
                border-bottom: 1px solid #A64468 !important;
              }

              .navbar-brand i {
                height: 50px !important;
                font-size: 34px !important;
                color: #A64468 !important;
                font-weight: 600 !important;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;


              }

              /* hero */

              .hero-header {
                background: linear-gradient(blue, black), url(../easylearn/img/logo2.jpg) !important;
              }

              .hero-header-two {
                background: linear-gradient(black, blue), url(../easylearn/img/logo2.jpg) !important;
              }

     

              .img3 {
                width: 450px !important;
                height: 450px !important;
              }

              /* carosel */
              .carousel,
              .container-xxl {
                width: 100% !important;
                height: 550px !important;
              }

              /* card */
              .card img {
                width: 100% !important;
                height: 37vh !important;
                object-fit: contain !important;
                background-size: cover;
              }


              .wrap {
                background: url(../easylearn/img/logo2.jpg);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;

              }


              .wraps img {
                object-fit: contain !important;
              }


              @media (max-width:965px) {
                .card img {
                  width: 100% !important;
                  height: 15rem !important;
                  object-fit: cover !important;


                }
              }
            </style>














<?php require "includes/dashboard-footer.php" ?>



            <script src="bootstrap/bootstrap.bundle.min.js"></script>

</body>

</html>