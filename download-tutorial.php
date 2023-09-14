<?php require "includes/dashboard-header.php"; ?>
<style>
.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
}

.teacher {
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 25px;
  margin-bottom: 50px;
  text-align: center;
  position: relative;
}

.teacher-img {
  margin-bottom: 20px;
}
.teacher-img img{
    max-width: 100%;
    border-radius: 50%;
    height: 12rem;
}

.teacher-info {
  padding: 10px;
}

.teacher-info h3 {
  margin-top: 0;
}

.teacher-info p {
  margin-bottom: 5px;
}

.enroll-btn {
  position: absolute;
  bottom: -20px;
  left: 50%;
  transform: translateX(-50%);
  transition: all 0.3s ease-in-out;
}

.enroll-btn:hover {
  bottom: -20px;
}


</style>
<body>

    <section class="container-fluid index-wrapper" style="padding-top: 6.5rem; padding-bottom: 5rem; background-color: #fff;">
        <?php require "includes/nav.php"; ?>
        <?php require_once "includes/footer-nav.php"; ?>

        <div class="container">
  <!-- <h2 class="text-center">Download Tutorial</h2> -->

        <div class="search-wrapper" style="margin: 2rem 0;">
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="What Tutorial are you looking for?" autocomplete="off" id="search" name="search">
                <i class="bi bi-search"></i>
            </div>
            <div class="search-result"></div>
        </div>

  <div class="row">

        <?php
        $output = '';


$sql = "SELECT * FROM tutorial WHERE status='active' LIMIT 2";
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
            $department = $row1['department'];
        }
    $output .= '
    <div class="col-md-4">
      <div class="teacher"> 
        <div class="teacher-img">
          <img src="uploads/'.$row1['image'].'">
        </div>
        <div class="teacher-info">
          <h3>'.$row['course_title'].'</h3>
          <p>'.$row1['school'].'</p>
          <p class="text-success">'.$row['amount'].'</p>
          <a href="buy-book.php?item_id='.$row['tutorial_id'].'" class="btn enroll-btn" style="background: blue; color: #fff; font-weight: 700;">Buy Course</a>
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
                <div class="login-form">
          
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">No Tutorial Available</h2>
              
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
    
    
    ';
}




        echo $output;
        ?>
         </div>
</div>
        <div class="instructor" style="margin-top: 1rem; padding-bottom: 5rem;">
            <div class="container text-center">
                <img src="./assets/img/easylearn/tutorial.png" style="max-width: 100%;" alt="">
                <h4 style="font-size: 2.7rem; font-weight: bold; padding-top: 2rem; padding-bottom: 1rem;">Become an instructor</h4>
                <p style="font-size: 1.7rem;">Instructors from around the world teach millions of students on Eazy Learn. We provide the tools and skills to teach what you love.</p>
                <a href="register-teacher.php" class="btn" style="width: 100%; margin-top: 1rem; background: blue; color: #fff; font-weight: 700;">Start teaching today</a>
            </div>
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
      

       $("#search").keyup(function(){
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"backend/download-pdf.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data){
                    $(".search-result").html(data);
                }
            });

       }
    });
       
    });
   </script>