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
        $dept = $row2['department'];
    }
}



$sql = "SELECT * FROM register_teachers WHERE department=? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $dept);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
            $user_id = $rows['teacher_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){ 
                $row1 = $result1->fetch_assoc();

                $output .= '
                <div style="box-shadow: 0px 0px 5px rgba(0,0,0,.3),0px 3px 5px rgba(0,0,0,.2),0px 3px 5px rgba(0,0,0,.15),0px 5px 7px rgba(0,0,0,.1),0px 5px 10px rgba(0,0,0,.05); padding: 2rem 0">
                <img src="uploads/'.$row1['image'].'" style="height: 14rem; width: 14rem; border-radius: 50%;">
                <h5>Teacher Name: <span>'.$row1['lastname'].' '.$row1['firstname'].'</span></h5>
                <h5>Department: <span>'.$row2['department'].'</span></h5>
                <h5>School: <span>'.$row1['school'].'</span></h5>
                <h5>Rating: <span>4/5</span></h5><br />
                <a href="teacher-choosen.php?teacher_id='.$user_id.'" class="assignment-pdf" style="border: none; background: blue;">Select Teacher</a>
                </div>
                <hr>
                ';

}
    }
}
} else {
    $output .= '
    <div style="font-weight: 700; margin-top: 5rem; font-size: 2rem;" class="text-center text-danger">No Teacher</div>
    
    ';
}
}

echo $output;
