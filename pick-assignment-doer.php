<?php
require_once "includes/dashboard-header.php"; 

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}


$sql = "SELECT * FROM register_teachers WHERE teacher_id != ? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    $counter1 = $result->num_rows;
}


$sql = "SELECT * FROM register_teachers WHERE teacher_id != ? AND status='pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    $pending_teachers = $result->num_rows;
}

$sql = "SELECT DISTINCT timestamp FROM register_house WHERE status='active'";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    $active_agents = $result->num_rows;
}

$sql = "SELECT DISTINCT timestamp FROM register_house WHERE status='pending'";
$stmt = $conn->prepare($sql);
if($stmt->execute()){
    $result = $stmt->get_result();
    $pending_agents = $result->num_rows;
}

$sql = "SELECT * FROM users WHERE user_id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    $counter2 = $result->num_rows;
}

$sql = "SELECT * FROM register_business WHERE user_id != ? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    $active_business = $result->num_rows;
}

$sql = "SELECT * FROM register_business WHERE user_id != ? AND status='pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    $pending_business = $result->num_rows;
}


?>  

<body>
    <style>
        .feed{
            margin-top: 2rem;
        }
        .feed-wrapper p{
            font-size: 1.6rem;
        }
        h5{
            font-size: 1.6rem;
            line-height: 1.5;
            font-weight: 700;
        }
        h5 span{
            opacity: .7;
        }
        #assignment-pdf, .assignment-pdf{
            background-color: rgb(214, 78, 101);
            padding: 1rem 3rem;
            color: #fff;
            border-radius: 25px;
        }
      .l1{
        background: rgb(151, 51, 51);
        height: 18rem;
         padding: 5rem 1.5rem;
         border-radius: 25px;
      }
      .l1 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
        line-height: 1.4;
      }
      .l1 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l2{
        background: rgb(50, 114, 50);
        height: 18rem;
        padding: 5rem 1.5rem;
        border-radius: 25px;
      }
      .l2 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
        line-height: 1.4;
      }
      .l2 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l3{
        background: rgb(95, 95, 153);
        height: 18rem;
        margin-top: 2rem;
        padding: 5rem 1.5rem;
        border-radius: 25px;
      }
      .l3 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l3 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l4{
        background: rgb(148, 78, 90);
        height: 18rem;
        margin-top: 2rem;
        padding: 5rem 1.5rem;
        border-radius: 25px;
      }
      .l4 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l4 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      
    </style>

    <section class="container-fluid index-wrapper" style="margin-bottom: 5rem;">
       <?php require_once "includes/admin-nav.php"; ?>
        <!-- ================= Navigation ================== -->
       <?php require "./includes/footer-nav.php"; ?>
        <!-- End Navigation -->

        <!-- ================= Feeds ================== -->

          <div class="assignment" style="width: 90%; margin: auto;">

          <div style="margin-top: 3rem;">
            
            <div class="student-dashboard"><br /><br />
                <div class="row">
                    <div class="col-xs-6">
                        <div class="l1">
                            <h4>Registered Users</h4>
                            <p><?= $counter2 ?></p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="l2">
                            <h4>Active Teachers</h4>
                            <p><?= $counter1; ?></p>
                        </div>
                    </div>
                    
                    <div class="col-xs-6">
                    <div class="l3">
                            <h4>Pending Teachers</h4>
                            <p><?= $pending_teachers; ?></p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="l4">
                            <h4>Active Agents</h4>
                            <p><?= $active_agents; ?></p>
                        </div>
                    </div><br />
                    <div class="col-xs-6">
                        <div class="l4">
                            <h4>Pending Agents</h4>
                            <p><?= $pending_agents; ?></p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="l3">
                            <h4>Active Business</h4>
                            <p><?= $active_business; ?></p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="l3">
                            <h4>Pending Business</h4>
                            <p><?= $pending_business; ?></p>
                        </div>
                    </div>
                </div>
                
            </div>


          </div>
        </div>


    </section>
</body>

<?php require_once "includes/dashboard-footer.php"; ?>
