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
                        <a href="business-dashboard.php">
                            <i class="bi bi-house"></i> Business Dashboard</a>
                    </li>   
                    <li>
                        <a href="upload-items.php">
                            <i class="bi bi-upload"></i> Upload Items</a>
                    </li>
                    <li>
                        <a href="edit-items.php">
                            <i class="bi bi-file-earmark-lock"></i> Edit Items</a>
                    </li>
                    <li>
                        <a href="edit-business.php">
                            <i class="bi bi-house"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a href="job.php">
                            <i class="bi bi-house"></i> Your Rating</a>
                    </li>
     
    </ul>
    </div>
</div>
