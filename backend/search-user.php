<?php
session_start();
include "../database/connection.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}

$sql = "SELECT DISTINCT u.user_id, u.firstname, u.lastname, u.image, u.school
        FROM friend_requests f
        INNER JOIN users u ON (f.friend_id = u.user_id OR f.user_id = u.user_id)
        WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted' AND u.user_id <> ?
        ORDER BY u.lastname, u.firstname";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $id, $id, $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .user-container {
            border: 2px solid linear-gradient(135deg, #AAAAAA, #CCCCCC);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            margin-bottom: 10px;
        }

        .user-container:hover {
            transform: translateY(-5px);
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .user-name {
            margin-left: 15px;
            font-size: 18px;
            color: black;
            font-weight: 700;
        }

        .user-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>

    <?php
    if ($result->num_rows) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
    ?>
            <section class="container-fluid login-wrapper pt-5">
                <a href="chat2.php?id=<?= $user_id; ?>" class="user-link">
                    <div class="container d-flex align-items-center user-container">
                        <img class="user-image" src="uploads/<?= $row['image']; ?>" alt="User Image">
                        <div class="user-details">
                            <p class="user-name"><?= $row['lastname'] . ' ' . $row['firstname']; ?></p>
                            <p style="padding-left: 1.5rem;"><?= $row['school']; ?></p>
                        </div>
                    </div>
                </a>
            </section>
    <?php
        }
    } else {
    ?>
        <section class="container-fluid login-wrapper pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="login-form">
                            <h2 class="pt-5 text-center text-danger" style="font-size: 2rem; line-height: 1.3;">No friends</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>
</body>

</html>
