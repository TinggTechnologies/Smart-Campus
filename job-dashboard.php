<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "header.php"; 
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

$rm_sql = "SELECT * FROM register_teachers WHERE teacher_id=?";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    @$stud = $rm_row['status'];
    $job = $rm_row['job'];
   }
}

if(@$stud == 'pending'){
    echo "<script>location.href = 'register-teacher4.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Teacher'){
    echo "<script>location.href = 'teacher-dashboard.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Business'){
    echo "<script>location.href = 'business-dashboard.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Transport'){
    echo "<script>location.href = 'transport-dashboard.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Agent'){
    echo "<script>location.href = 'agent-dashboard.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Donate Pdf'){
    echo "<script>location.href = 'donate-pdf-dashboard.php';</script>"; 
} else if(@$stud == 'active' && $job == 'Easy Learn Agent'){
    echo "<script>location.href = 'easy-learn-agent-dashboard.php';</script>"; 
} else {
    echo "<script>location.href = 'job.php';</script>"; 
}
?>