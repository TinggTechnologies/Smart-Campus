<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
    $department = $row['department'];
    $school = $row['school'];
    $faculty = $row['faculty'];

    $sql = "SELECT * FROM users WHERE (department=? OR school=? OR faculty=?) AND user_id != ? ORDER BY RAND() LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $department, $school, $faculty, $id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($friends_row = $result->fetch_assoc()){
                
         $output .= '         
                <form id="follower_form"></form>
               <li class="follower d-flex-sb">
                <a href="friends-profile.html">
                    <div class="follower-img"><img src="uploads/'. $friends_row['image'].'"></div>
                    
                    <div class="follower-info">
                        <h4>'. $friends_row['lastname'] . ' '. $friends_row['firstname'].'</h4>
                        <h5 style="font-weight: 500;">'. $friends_row['school'].'</h5>
                        <p>'. $friends_row['department'].'</p>
                    </div>
                </a>
                <input type="hidden" id="user_id" value="'. $id.'">
                <input type="hidden" id="friend_id" value="'. $friends_row['user_id'].'">
                <div class="follow-btn"><a href="friends-profile.php?user_id='. $friends_row['user_id'].'" class="btn btn-primary" id="follower_btn">See Profile</a></div>
            </li>
            </form>';


            }
        }
    }

    echo $output;
           