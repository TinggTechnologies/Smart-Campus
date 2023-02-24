<?php
require_once "includes/dashboard-header.php"; ?>

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
        #assignment-pdf{
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

          <div class="assignment" style="padding-top: 4rem; width: 90%; margin: auto;">
          <h3 style="padding-bottom: 1rem;">Paid Assignment</h3>
          <p style="padding-bottom: 3rem;">The following are list of assignments that students have paid. <br /><br />
        you can begin to solve this particular assignment to get paid. Make sure you finish before deadline to get your full payment.</p>
            <div class="assignment-student" style="padding-bottom: 4rem;">
           
            </div>


          </div>
        </div>


    </section>
</body>

<?php require_once "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/paid-assignment.php",
                method: "POST",
                success: function(data){
                    $(".assignment-student").html(data);
                }
            });
        }

       
    });
   </script>