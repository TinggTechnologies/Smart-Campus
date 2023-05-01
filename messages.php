<?php require "includes/dashboard-header.php"; ?>
<body>

    <section class="container-fluid index-wrapper" style="background-color: #fff;">
        <header class="d-flex-sb" style="padding-bottom: 1rem;">
            <a href="javascript:history.back()"><i class="bi bi-chevron-left"></i></a>
            <h3>Messages</h3>
            <a href="#"><i class="bi bi-box-arrow-in-down-left chats"></i></a>
        </header>

        <div class="messages-wrapper">
        <div class="search-wrapper">
                <div class="search-box d-flex-sb">
                    <input type="search" placeholder="Search Messages..." id="search">
                    <i class="bi bi-search"></i>
                </div>
                <hr>
            </div>

        <div class="mes">

        </div>
        <?php require "includes/footer-msg.php"; ?>
            
                
            
        </div>
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>
   <script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/tester.php",
                method: "POST",
                success: function(data){
                    $(".mes").html(data);
                }
            });
        }

        $("#search").keyup(function(){
            $(".mes").hide();
        var query = $("#search").val();
    
       if(query != ""){

            $.ajax({
                url:"backend/search-user.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data){
                    $(".mes").html(data);
                }
            });

       }
    });
    });
   </script>