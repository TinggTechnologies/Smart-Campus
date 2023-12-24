<?php
session_start();
include "../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    $sql = "SELECT like_count FROM post WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $post_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $row['like_count'];
    } else {
        echo '0';
    }
} else {
    echo '0';
}
?>
