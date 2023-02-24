<?php
require_once "includes/dashboard-header.php"; ?>
<?php
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}

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



$sql = "SELECT * FROM assigment WHERE department=? AND student_id=? ORDER BY assignment_id limit 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $department, $student_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
        $user_id = $rows['student_id'];
        $assignment_id = $rows['assignment_id'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $student_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){ 
                $row1 = $result1->fetch_assoc();
            }
        }
    }
}



                ?>

<body>
    <style>
        .feed{
            margin-top: 2rem;
        }
        .feed-wrapper p{
            font-size: 1.6rem;
        }
        h5{
            font-size: 1.6rem;
            line-height: 1.5;
            font-weight: 700;
        }
        h5 span{
            opacity: .7;
        }
        #assignment-pdf, .assignment-pdf{
            background-color: rgb(214, 78, 101);
            padding: 1rem 3rem;
            color: #fff;
            border-radius: 25px;
        }
      
    </style>

    <section class="container-fluid index-wrapper" style="margin-bottom: 5rem;">
       <?php require_once "includes/teacher-nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <nav class="nav d-flex-sb">
            <div>
                <ul class="d-flex-sa">
                    <li class="">
                        <a href="dashboard.php">
                            <i class="bi bi-house-door-fill" style="color: rgb(214, 78, 101);"></i>
                        </a>
                    </li>
                    <li>
                        <a href="search.html">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <a href="create-post.php" class="nav-add-btn">
                <i class="bi bi-plus-circle-fill"></i>
            </a>
            <div>
                <ul class="d-flex-sa">
                    <li>
                        <a href="notification.html">
                            <i class="bi bi-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="followers.php">
                            <i class="bi bi-people"></i>
                    </li>
                    </a>
                </ul>
            </div>
        </nav>
        <!-- End Navigation -->

        <!-- ================= Feeds ================== -->
        <div class="job-wrapper"> 

          <div class="assignment" style="padding-top: 4rem; width: 90%; margin: auto;">
            <div class="assignment-student" style="padding-bottom: 4rem;">
            <img src="<?= $row1['image']; ?>" style="height: 14rem; width: 14rem;" alt="">
                <h5>Student Name: <span><?= $row1['lastname']; ?> <?= $row1['firstname']; ?></span></h5>
                <h5>Course Title: <span><?= $rows['course_title']; ?></span></h5>
                <h5>Status: <span><?= $rows['status']; ?></span></h5>
                <h5>No of Pages: <span><?= $rows['no_of_pages']; ?></span></h5>
                <h5>Deadline: <span><?= $rows['deadline']; ?></span></h5>
                <h5>Course Description: <span><?= $rows['course_description']; ?></span></h5><br />
                <form id="assignment_form">
            <input type="text" class="form-control" id="price" placeholder="Enter a price">
            <input type="hidden" class="form-control" id="student_id" value="<?= $student_id; ?>">
            <input type="hidden" class="form-control" id="teacher_id" value="<?= $id; ?>">
            <input type="hidden" class="form-control" id="assignment_id" value="<?= $assignment_id; ?>">
            <br />
           <div class="d-flex">
            <a id="assignment-pdf" href="">Download Assignment</a>
            <a id="pick-assignment" class="assignment-pdf" style="margin-left: 1rem; cursor: pointer;">Pick Assignment</a>
            </div>
           </form><br />
            <div class="text-center">
                
            </div>
            </div>
            
          </div>
        </div>


    </section>
</body>

<?php require_once "includes/dashboard-footer.php"; ?>

<script>
    $(document).on('click', '#pick-assignment', function(e){
        e.preventDefault();

        var price = $('#price').val();
        var student_id = $('#student_id').val();
        var teacher_id = $('#teacher_id').val();
        var assignment_id = $('#assignment_id').val();

        if(price == "")
            {
          Swal.fire(
            'Invalid',
            'Price cannot be empty',
            'error'
          )
        }

        else{
            $.ajax({
                url: 'backend/pick-assignment.php',
                type: 'post',
                data:
                {
                    price: price,
                    student_id:student_id,
                    teacher_id:teacher_id,
                    assignment_id: assignment_id
                },
                success: function(response){
                    Swal.fire(
                    'Success',
                    'Price Successfully sent to the student',
                    'success'
          )
                }
            });
            $('#assignment _form')[0].reset();
        }
    });
</script>