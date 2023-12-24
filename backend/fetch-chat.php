<?php

session_start();
include "../database/connection.php";
date_default_timezone_set('Africa/Lagos');

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}

$output = '';

function formatPostTime($postTime, $timezone = 'Africa/Lagos') {
    // Create DateTime objects for the current time and the post time
    $currentTime = new DateTime('now', new DateTimeZone($timezone));
    $postTime = new DateTime($postTime, new DateTimeZone($timezone));

    // Calculate the difference in time
    $interval = $postTime->diff($currentTime);

    // Define singular and plural units for each time interval
    $units = [
        'y' => ['year', 'years'],
        'm' => ['month', 'months'],
        'd' => ['day', 'days'],
        'h' => ['hour', 'hours'],
        'i' => ['minute', 'minutes'],
        's' => ['second', 'seconds']
    ];

    // Check each unit and return the appropriate representation
    foreach ($units as $key => $unit) {
        if ($interval->$key > 0) {
            $unitStr = ($interval->$key === 1) ? $unit[0] : $unit[1];
            return $interval->$key . ' ' . $unitStr . ' ago';
        }
    }

    return 'just now';
}

$incoming_id = $_POST['incoming_id'];
$outgoing_id = $_POST['outgoing_id'];

$sql1 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();

if ($result->num_rows > 0) {
    $sql3 = "UPDATE messages SET alert = '1' WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();

    while ($fetch = $result->fetch_assoc()) {
        $postTime = $fetch['time'];
        $formattedTime = formatPostTime($postTime);
        @$timing = substr($fetch['time'], 9, );

        if ($fetch['outgoing_id'] === $outgoing_id) {
            $output .=  '
                <div class="my-msg">
                    ' . getMessageContent($fetch) . '
                    <small class="time">' . @$timing . '</small>
                </div>
            ';
        } else {
            $output .= '
                <div class="friend-msg">
                    ' . getMessageContent($fetch) . '
                    <small class="time">' . @$timing . '</small>
                </div>
            ';
        }
    }
}

echo $output;
if ($result->num_rows === 0) {
    echo "<div class='text-center mt-5 pt-5 fw-bold'>No Message</div>";
}

function getMessageContent($message)
{
    if ($message['file_path'] !== null) {
        // Check the file type and display accordingly
        $mediaType = pathinfo($message['file_path'], PATHINFO_EXTENSION);

        // Allowed image types
        $imageTypes = array('jpg', 'jpeg', 'png', 'gif');
        // Allowed document types
        $documentTypes = array('pdf', 'docx');

        if (in_array($mediaType, $imageTypes)) {
            return '<img style="width: 15rem;" src="./uploads/' . $message['file_path'] . '" alt="Image">';
        } elseif (in_array($mediaType, $documentTypes)) {
            return '<a href="./download.php?path=uploads/' . $message['file_path'] . '">' . ucfirst($mediaType) . ' Document</a>';
        } else {
            return '<p>' . $message['message'] . '</p>';
        }
    } else {
        return '<p>' . $message['message'] . '</p>';
    }
}

?>
