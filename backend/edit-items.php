<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
if(isset($_SESSION['ass_code'])){
    $ass_code = $_SESSION['ass_code'];
}
$output = '';


$sql = "SELECT * FROM products WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
            $user_id = $rows['user_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){ 
                $row1 = $result1->fetch_assoc();

                $output .= '
                <img src="uploads/'.$rows['image'].'" style="height: 14rem; width: 14rem;" alt="">
                <h5>Item Name: <span>'.$rows['item_name'].'</span></h5>
                <h5>Price: <span>'.$rows['price'].'</span></h5>
                <h5>Category: <span>'.$rows['category'].'</span></h5>
                <a href="edit-item.php?item_id='.$rows['id'].'" class="assignment-pdf" style="border: none; background: blue;">Edit Item</a>
                <hr>
                ';

}
    }
}
} else {
    $output .= '
    <div style="font-weight: 700; margin-top: 5rem; font-size: 2rem;" class="text-center text-danger">No Item</div>
    
    ';
}
}

echo $output;
