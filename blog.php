
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/easylearn/logo-cut.png" rel="icon">
    <link href="./assets/img/easylearn/logo-cut.png" rel="apple-touch-icon">

    <title>Smart Campus</title>
    <link rel="stylesheet" href="moyin_vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="moyin_vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="moyin_css/style.css">
    <link rel="stylesheet" href="moyin_css/query.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>

<section class="index-wrapper">
        <!-- ================= Nav ================== -->
       <?php require "includes/blog-nav.php"; ?>
       

        <!-- ================= Footer Nav ================== -->
        <?php require "includes/footer-nav.php"; ?>
        <!-- End Footer Nav -->

        <!-- ================= Post here ================== -->
        <div class="post-here d-flex-sb">
            <div class="phd d-flex">
                <div class="phd-img-div"><a href="profile.php"><img src="./assets/img/easylearn/student3.gif"></a></div>
                <input type="text" class="open-create-post" placeholder="What's new on campus?">
                
            </div>
             
           
        </div>
        
        <!-- End Post here -->
        <div id="postPopup" class="modal">
        <div class="modal-content">
        
    </div>
    
</div>


        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper">

            
           
            

        </div>
        <!-- End Feeds -->
    </section>

    <script src="moyin_js/jquery2.js"></script>
    <script src="moyin_js/index.js"></script>

   <script>
    
    $(document).ready(function(){
    
        fetch_user();

        $(document).on('click', '.feed-text', function(){
            location.href = 'create-post.php';
        });

        function fetch_user(){
            $.ajax({
                url:"backend/blog.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                }
            });
        }

       
    });
   </script>
