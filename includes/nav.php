 <!-- ================= Header ================== -->
<?php

require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
?>
 
 <style>
    .logo{
        font-size: 25px;
  margin: 0;
  font-weight: 700;
  color: #fff;
  font-family: cursive;
  color: rgba(0,0,0,.7);
    }
    .profile{
        justify-content: center;
        align-items: center;
    }
    .profile img{
        margin-right: 1.2rem;
    }
 
 </style>

<div class="nav-container">
    <div class="menu-toggle">
    <a href="./dashboard.php"><img src="./assets/img/easylearn/logo3.jpg" style="width: 13rem;" alt="Eazy Learn Logo"></a>
    <div style="display: flex; align-items: center;">
    <div class="">
           <!-- <a href="./profile.php"><img src="<?= $row['image']; ?>" alt=""></a> -->
            <div class="mes">

             </div>
           </div>
    <div class="clickme" style="padding-left: 2rem;">
    <span></span>
    <span></span>
    <span></span>
    </div>

</div>
    <ul class="menu-links">
    <li>
                        <a href="pq1.php">
                            <i class="bi bi-file-richtext"></i> Past Question</a>
                    </li>   
                    <li>
                        <a href="donate-pdf.php">
                            <i class="bi bi-file-pdf"></i> Donate Pdf</a>
                    </li>
                    <li>
                        <a href="assignment-solver.php">
                            <i class="bi bi-file-earmark-lock"></i> Assignment Solver</a>
                    </li>
                    <li>
                        <a href="hostel-intro.php">
                            <i class="bi bi-house"></i> Hostel Finder</a>
                    </li>
                    <li>
                        <a href="room-mate-finder1.php">
                            <i class="bi bi-people"></i> Room Mate Finder</a>
                    </li>
                    <li>
                        <a href="tutorial1.php">
                            <i class="bi bi-file-earmark-easel"></i> Tutorial</a>
                    </li>
                    <li>
                        <a href="index-shop.php">
                            <i class="bi bi-cart4"></i> Online Shop</a>
                    </li>
                    <li>
                        <a href="job.php">
                            <i class="bi bi-person"></i> Join Team</a>
                    </li>

                    <li>
                        <a href="job-dashboard.php">
                            <i class="bi bi-app-indicator"></i> Job Dashboard</a>
                    </li>
                    <li>
                        <a href="settings.php">
                            <i class="bi bi-controller"></i> Settings</a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="bi bi-box-arrow-in-right"></i> Logout</a>
                    </li>
    </ul>
    </div>
</div>
