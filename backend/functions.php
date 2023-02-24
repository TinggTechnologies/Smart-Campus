<?php
require "../database/connection.php";

function is_user_online($user_id){
    global $conn;

    $sql = "SELECT last_activity FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $rows = $result->fetch_assoc();
        $last_activity = strtotime($rows['last_activity']);
        $current_time = time(); 
        $timeout = 32700;
        if($current_time - $last_activity <= $timeout){
            return true;
        }
    }
    return false; 
}