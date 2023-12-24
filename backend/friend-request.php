<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

    $sql = "SELECT * FROM friend_requests WHERE friend_id = ? AND status='pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($friendss_row = $result->fetch_assoc()){
                $fid = $friendss_row['user_id'];
                $sql1 = "SELECT * FROM users WHERE user_id = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('s', $fid);
                if($stmt1->execute()){
                    $result1 = $stmt1->get_result();
                    if($result1->num_rows > 0){
                        $friends_row = $result1->fetch_assoc();
                
         ?>      
                <form id="follower_form">
               <li class="follower d-flex-sb">
                <a href="friends-profile2.php">
                    <div class="follower-img"><img src="uploads/<?= $friends_row['image']; ?>"></div>
                    
                    <div class="follower-info">
                        <h4><?= $friends_row['lastname'] . ' '. $friends_row['firstname']; ?></h4>
                        <h5 style="font-weight: 500;"><?= $friends_row['school']; ?></h5>
                        <p><?= $friends_row['department']; ?></p>
                    </div>
                </a>
                <input type="hidden" id="user_id" value="<?= $id; ?>">
                <input type="hidden" id="friend_id" value="<?= $friends_row['user_id']; ?>">
                <div class="follow-btn"><button onclick="acceptFriendRequest('<?= $friendss_row['user_id']; ?>')" style="font-size: 1rem;" class="btn btn-primary">Accept Request</button></div>

            </li>
            </form>
<?php

            }
        }}}else {
           ?>
            
            <form id="follower_form">
               <li class="follower d-flex-sb">
                    
                    <div class="follower-info text-center text-primary">
                        <h4>No  Friends Request</h4>
                    </div>

            </li>
            </form>

            <?php
            
        }
    }

 
           