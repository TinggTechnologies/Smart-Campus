<?php require "includes/dashboard-header.php"; 


?>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem; background-color: #fff;">

        <?php require_once "includes/pq-nav.php"; ?>
        <?php require "includes/footer-nav-no.php"; ?>

        <div>
        <p style="font-size: 1.7rem;">Download free exam past questions for all Nigerian Universities, Polytechnics, Colleges and Professional Institutions.</p>
        </div>

        <div class="search-wrapper" style="margin-top: 1rem; padding-bottom: 3rem;">
            <hr>
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="enter course title..." autocomplete="off" id="search" name="search">
                <i class="bi bi-search"></i>
            </div>
            <hr>
            <div class="search-result"></div>
            <?php
$output = '';
$depart = $row['department'];
$sql = "SELECT * FROM past_question WHERE department='$depart' AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
        $user_id = $row['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id='$user_id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
            $name = $row1['lastname'] . " " . $row1['firstname'];
            $department = $row1['department'];
        }
    $output .= '
    <body>
    <section class="container-fluid login-wrapper pt-1">
        <div>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form" style="border: 2px solid #ccc; padding: 20px; border-radius: 25px;">
          
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">'.$row['course_title'].'</h2>
                <span style="font-weight: 500; font-size: 1.7rem;">Department: '.$department.'</span><br />
                <span style="font-weight: 500; font-size: 1.7rem;">Institution: '.$row1['school'].'</span><br />
                <span style="font-weight: 500; font-size: 1.7rem;">Price: #'.$row['price'].'</span><br />
                <form id="profile_form">                         
                    <div class="form-group">
                        <a href="download-past-question2.php?pq_id='.$row['id'].'" i style="padding: 1rem 3rem;" class="getStarted-btn">Buy Now</a>
                    </div>
                </form>
               
            </div><hr>
                </div>
            </div>
           
        </div>
    </section>
    ' ;
}
} 




        echo $output;
            ?>
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
      

       $("#search").keyup(function(){
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"backend/download-past-question.php",
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