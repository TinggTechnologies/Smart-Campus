<?php
session_start();
include "../database/connection.php";
// date_default_timezone_set('Africa/Lagos');

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
$output = '';

$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

$sql = "SELECT * FROM post WHERE user_id='$id' ORDER BY post_id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
?>
<style>
    .feed-post-media {
    max-width: 100%; /* Ensure the media doesn't overflow its container */
}

.media-content {
    max-width: 100%; /* Max width of the media content */
    height: auto; /* Maintain the aspect ratio */
}
</style>
        <span class="close">Close</span>
        <div id="postContent">
            <div class="feed-post">
                <div class="feed-post-author-details d-flex-sb">
                    <div class="fpad-box d-flex">
                        <a href="friends-profile2.php?user_id=<?= $row['user_id']; ?>" class="d-flex-sb">
                            <img src="uploads/<?= $row['image']; ?>">
                            <div class="fpad-author-name">
                                <h4><?= $row['lastname'] . " " . $row['firstname']; ?></h4>
                                <small>now<i class="bi bi-hourglass-split"></i></small>
                            </div>
                        </a>
                    </div>
                </div>
                <p class="post-content"><?= $rows['text']; ?></p>
                <div class="feed-post-media">
                    <?php
                    $mediaType = pathinfo($rows['post_image'], PATHINFO_EXTENSION);
                    if (in_array($mediaType, array('jpg', 'jpeg', 'png', 'gif'))) {
                    ?>
                        <!-- Display Image -->
                        <img class="media-content" src="uploads/<?= $rows['post_image']; ?>" alt="Image">
                    <?php
                    } elseif (in_array($mediaType, array('mp4', 'webm', 'quicktime'))) {
                    ?>
                        <!-- Display Video -->
                        <video class="media-content" controls>
                            <source src="uploads/<?= $rows['post_image']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
}
