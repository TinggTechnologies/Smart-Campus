<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$output = '';

$sql2 = "SELECT * FROM users WHERE user_id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('s', $id);
if($stmt2->execute()){
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){ 
        $row2 = $result2->fetch_assoc();
        $department = $row2['department'];
    }
}



$sql = "SELECT * FROM assigment WHERE department=? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $department);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
        $user_id = $rows['student_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){ 
                $row1 = $result1->fetch_assoc();

                $output .= '
                <img src="'.$row1['image'].'" style="height: 14rem; width: 14rem;" alt="">
                <h5>Student Name: <span>'.$row1['lastname'].' '.$row1['firstname'].'</span></h5>
                <h5>Course Title: <span>'.$rows['course_title'].'</span></h5>
                <h5>Status: <span>'.$rows['status'].'</span></h5>
                <h5>No of Pages: <span>'.$rows['no_of_pages'].'</span></h5>
                <h5>Deadline: <span>'.$rows['deadline'].'</span></h5>
                <h5>Course Description: <span>'.$rows['course_description'].'</span></h5><br />
                <a id="assignment-pdf" href="pick-assignment.php?student_id='.$row1['user_id'].'">See Assignment</a>
                <hr>
                ';

}
    }
}
} else {
    $output .= "no paid assignment";
}
}
echo $output;
