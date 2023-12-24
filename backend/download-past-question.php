<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$sql = "SELECT * FROM past_question WHERE course_title LIKE '%{$_POST['query']}%' AND status='active'";
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
    ?>
    <div class="best-product-area lf-padding" style="width: 100%; margin-bottom: 1rem;">
           <div class="product-wrapper bg-height" style="background: rgba(0,0,255,.07);">
                <div class="container position-relative">
                    <div class="row justify-content-between align-items-end">
                        <div class="product-man position-absolute  d-none d-lg-block">
                            <img src="assets/img/categori/card-man.png" alt="">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                            <div class="vertical-text">
                                <span>Smartcampus</span>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="best-product-caption text-center">
                            <h2><?= $row['course_title'] ?></h2>
                                <p><?= $row['description'] ?></p>
                                <a href="pq-checkout.php?pq_id=<?=$row['pastquestion_id']; ?>" class="btn">Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
                      
                    </div><br />
<?php
}
} else {
    ?>
    
    <body>
    <section class="container-fluid login-wrapper">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div style="text-align: center;">
          
               
                <span style="font-size: 1.5rem; color: red;">No Past Question</span>             
               
            </div>
                </div>
            </div>
           
        </div>
    </section>


<?php
}




   