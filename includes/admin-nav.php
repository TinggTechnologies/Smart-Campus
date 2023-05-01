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
                        <a href="admin-dashboard.php">
                            <i class="bi bi-house-door"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="pick-assignment-doer.php">
                            <i class="bi bi-graph-down-arrow"></i> Analysis</a>
                    </li>
                    <li>
                        <a href="approve-teacher.php">
                            <i class="bi bi-file-person"></i> Approve Teacher</a>
                    </li>
                    <li>
                        <a href="approve-agent.php">
                            <i class="bi bi-house"></i> Approve Agent</a>
                    </li>
                    <li>
                        <a href="approve-business.php">
                            <i class="bi bi-cart2"></i> Approve Business</a>
                    </li>
                    <li>
                        <a href="approve-pq.php">
                            <i class="bi bi-file-earmark-pdf"></i> Approve Past Question</a>
                    </li>
                    <li>
                        <a href="approve-tutorial.php">
                            <i class="bi bi-webcam"></i> Approve Tutorial</a>
                    </li>
                    <li>
                        <a href="total-users.php">
                            <i class="bi bi-people"></i> Total Users</a>
                    </li>
     
    </ul>
    </div>
</div>
