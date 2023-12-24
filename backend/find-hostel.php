<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$sql3 = "SELECT * FROM users WHERE user_id=?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param('s', $id);
$stmt3->execute();
$result3 = $stmt3->get_result();
if($result3->num_rows){
    $row3 = $result3->fetch_assoc();
        $school = $row3['school'];
}

$output = '';

$sql = "SELECT DISTINCT user_id,house_title,town,house_type,timestamp FROM register_house WHERE town LIKE '%{$_POST['query']}%' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows){
    while($row = $result->fetch_assoc()){
        $time = $row['timestamp'];
        $user_id = $row['user_id'];
        $sql4 = "INSERT INTO visitors(visitor_id, owner_id, feature) VALUES(?,?,'hostel')";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param('ss', $user_id, $id);
        $stmt4->execute();
        $sql1 = "SELECT * FROM register_house WHERE timestamp='$time' ";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows){
            $row1 = $result1->fetch_assoc();
                $file = $row1['file'];
        }
       
    // Check file extension to determine if it's a video or image
    $file_extension = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array(strtolower($file_extension), ['mp4', 'avi', 'mov'])) {
        // It's a video
        $output .= '
            <div class="col-lg-4 col-md-6 mix all house">
                <div class="property-item">
                    <div class="pi-pic set-bg">
                        <a href="./property-details.php?time=' . $row['timestamp'] . '">
                            <video width="100%" controls style="width: 100%; height: 17rem;">
                                <source src="../' . $file . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="label">For ' . $row['house_type'] . '</div>
                    </div><br /><br />
                    <div class="pi-text">
                        <div class="pt-price">' . $row1['price'] . '<span>/year</span></div>
                        <h5><a href="">' . $row['house_title'] . '</a></h5>
                        <p><span class="icon_pin_alt"></span> ' . $row['town'] . '</p>
                        <ul>
                            <li><i class="fa fa-bathtub"></i> ' . $row1['toilet'] . '</li>
                            <li><i class="fa fa-bed"></i> ' . $row1['bedroom'] . '</li>
                            <a href="./property-details.php?time=' . $row['timestamp'] . '"> View Hostel </a>
                        </ul>
                    </div>
                </div>
            </div>';
    } elseif (in_array(strtolower($file_extension), ['jpg', 'png', 'jpeg', 'gif'])) {
        // It's an image
        $output .= '
            <div class="col-lg-4 col-md-6 mix all house">
                <div class="property-item">
                    <div class="pi-pic set-bg">
                        <a href="./property-details.php?time=' . $row['timestamp'] . '">
                            <img src="../' . $file . '" style="width: 100%; height: 17rem;" />
                        </a>
                        <div class="label">For ' . $row['house_type'] . '</div>
                    </div><br /><br />
                    <div class="pi-text">
                        <div class="pt-price">' . $row1['price'] . '<span>/year</span></div>
                        <h5><a href="">' . $row['house_title'] . '</a></h5>
                        <p><span class="icon_pin_alt"></span> ' . $row['town'] . '</p>
                        <ul>
                            <li><i class="fa fa-bathtub"></i> ' . $row1['toilet'] . '</li>
                            <li><i class="fa fa-bed"></i> ' . $row1['bedroom'] . '</li>
                        </ul>
                    </div>
                </div>
            </div>';
}}} else {
    $output .= '<div class="text-danger text-center" style="font-size: 1.3rem; padding-bottom: 1rem;"> No Hostel </div>';
}




        echo $output;