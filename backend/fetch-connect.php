<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){ 
    $id = $_SESSION['id'];
}

$output = '';

$message = trim($_POST['message']);
$message = htmlspecialchars($message);
$message = stripslashes($message);

$incoming_id = $_POST['incoming_id'];

$outgoing_id =  $_POST['outgoing_id'];

$sql1 = "SELECT * FROM connect WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows > 0){
$sql3 = "UPDATE connect SET alert = '1' WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
while($fetch = $result->fetch_assoc()){
if($fetch['outgoing_id'] === $outgoing_id){
    echo '
    <div class="my-msg">
                    <p>'.$fetch['message'].'</p>
                </div>
    ';
} else{
    echo '
    <div class="friend-msg">
    <p>'.$fetch['message'].'</p>
</div>
    ';
}
}
}
if($result->num_rows === 0){
echo "<div class='text-center mt-5 pt-5 fw-bold'>No Message</div>";
}