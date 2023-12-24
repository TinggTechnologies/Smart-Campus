<?php
require "header.php"; 
require "nav.php";

$output = '';

$sql = "SELECT DISTINCT user_id,house_title,town,house_type,timestamp FROM register_house WHERE status='active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows) {
    while ($row = $result->fetch_assoc()) {
        $time = $row['timestamp'];
        $user_id = $row['user_id'];
        $sql4 = "INSERT INTO visitors(visitor_id, owner_id, feature) VALUES(?,?,'hostel')";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param('ss', $user_id, $id);
        $stmt4->execute();
        $sql1 = "SELECT * FROM register_house WHERE timestamp=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $time);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows) {
            $row1 = $result1->fetch_assoc();
            $file = $row1['file'];

            // Check file extension to determine if it's a video or image
            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array(strtolower($file_extension), ['mp4', 'avi', 'mov'])) {
                // It's a video
                $output .= '
                    <div class="col-lg-4 col-md-6 mix all house">
                        <div class="property-item">
                            <div class="pi-pic set-bg">
                                <a href="./property-details.php?time=' . $row['timestamp'] . '">
                                    <video width="100%" controls>
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
            }
        }
    }
}
?>

<!-- Property Section Begin -->
<section class="property-section latest-property-section spad mt-3 pt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title">
                    <h4>Latest PROPERTY</h4>
                </div>
            </div>
        </div>
        <div class="row property-filter">
            <?= $output; ?>
        </div>
    </div>
</section>
<!-- Team Section End -->

<!-- Search Section Begin -->
<section class="search-section spad mt-3 pt-4 mb-0 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title">
                    <h4>Where would you rather live?</h4>
                </div>
            </div>
        </div>
        <div class="search-form-content">
            <form class="filter-form">
                <div class="sm-width">
                    <input class="sm-width" style="height: 3.5rem;" type="search" placeholder="Enter Location" id="search" name="search" />
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Search Section End -->
<div class="search-result"></div>

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.richtext.min.js"></script>
<script src="js/image-uploader.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        $("#search").keyup(function () {
            var query = $("#search").val();
            if (query != "") {
                $.ajax({
                    url: "../backend/find-hostel.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        $(".search-result").html(data);
                    }
                });
            }
        });
    });
</script>
