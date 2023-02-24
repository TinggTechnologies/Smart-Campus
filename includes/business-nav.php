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
    ul{
        padding-top: 5rem;
    }
    ul li{
        padding: .5rem 0;
        padding-left: 1rem;
    }
    ul li a{
        font-size: 1.5rem;
    }
    .profile{
        justify-content: center;
        align-items: center;
    }
    .profile img{
        margin-right: 1.2rem;
    }
 
 </style>
 <header class="d-flex-sb" style="background-color: white;">
 
            <i class="bi bi-filter-left slider" style="font-family: cursive; font-size: 4rem;"></i>
            <div class="index-dropdown" style="margin-top: 1rem;">
                
                <ul>
                    <li>
                        <a href="business-dashboard.php">
                            <i class="bi bi-house-door"></i> Dashboard</a>
                    </li>
            
                    <li>
                        <a href="upload-items.php">
                            <i class="bi bi-upload"></i> Upload items</a>
                    </li>
                    <li>
                        <a href="edit-items.php">
                            <i class="bi bi-upload"></i> Edit items</a>
                    </li>
                    <li>
                        <a href="edit-business.php">
                            <i class="bi bi-brush"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a href="job.php">
                            <i class="bi bi-star"></i> Your Rating</a>
                    </li>
                 
                </ul>
            </div>
            <h1 class="logo">Business</h1>
           <div class="div d-flex profile">
           <img src="<?= $row['image']; ?>" alt="">
            <div class="mes">

             </div>
           </div>


            

        </header>
        <!-- End Header -->
