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
    header {
        z-index: 100;
    }
    video {
        z-index: 1;
    }
</style>
 
 <header class="d-flex-sb">
            <i class="bi bi-list-nested slider"></i>
            <!-- Menu Dropdown -->
            <div class="menu-dropdown">
                <div class="top">
                    <i class="bi bi-info-circle" title="Info"></i>
                </div>
                <ul>
                    <li>
                        <a href="profile.php" class="slider-profile-details d-flex">
                            <img src="uploads/<?= $row['image']; ?>">
                            <div>
                                <span><?= $row['lastname'] . ' ' . $row['firstname']; ?></span>
                                <p><?= $row['department']; ?></p>
                            </div>
                        </a>
                    </li>
                    <hr>
                    <li><a href="./store/agent-dashboard.php"><i class="bi bi-app-indicator"></i> Dashboard</a></li>
                    <li><a href="./store/download_pastquestion.php"><i class="bi bi-file-earmark-pdf"></i> Past Question</a></li>
                    <li><a href="./store/download-tutorial.php"><i class="bi bi-file-easel"></i> Tutorial</a></li>
                    <li><a href="./store"><i class="bi bi-basket"></i> Marketplace</a></li>
                    <li><a href="assignment-solver1.php"><i class="bi bi-book"></i> Assignment Solver</a></li>
                    <li><a href="room-mate-finder1.php"><i class="bi bi-people"></i> Roommate Finder</a></li>
                    <li><a href="./house"><i class="bi bi-building"></i> Hostel Finder</a></li>
                    <hr>
                    <li><a href="settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                </ul>
            </div>
            <!-- End Menu Dropdown -->
            <img src="./assets/img/easylearn/logo-cut.png" style="width: 5rem;">

        </header>
