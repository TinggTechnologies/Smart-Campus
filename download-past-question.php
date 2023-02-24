<?php require "includes/dashboard-header.php"; 


?>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem;">

        <?php require_once "includes/nav.php"; ?>
        <?php require "includes/footer-nav-not.php"; ?>

        <div>
        <p style="font-size: 1.7rem;">Download free exam past questions and answers for all Nigerian Universities, Polytechnics, Colleges and Professional Institutions.</p>
        </div>

        <div class="search-wrapper" style="margin-top: 1rem;">
            <hr>
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="enter course title..." autocomplete="off" id="search" name="search">
                <i class="bi bi-search"></i>
            </div>
            <hr>
            <div class="search-result"></div>
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
      

       $("#search").keyup(function(){
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"backend/download-past-question.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data){
                    $(".search-result").html(data);
                }
            });

       }
    });
       
    });
   </script>