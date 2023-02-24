<?php require "includes/dashboard-header.php"; ?>
<body>

    <section class="container-fluid index-wrapper">
        <header class="d-flex-sb">
            <a href="javascript:history.back()"><i class="bi bi-chevron-left"></i></a>
            <h3>Room Mate Messages</h3>
            <a href="#"><i class="bi bi-box-arrow-in-down-left chats"></i></a>
        </header>

        <div class="messages-wrapper">
        <div class="search-wrapper">
                <div class="search-box d-flex-sb">
                    <input type="search" placeholder="Search Messages...">
                    <i class="bi bi-search"></i>
                </div>
                <hr>
            </div>

        <div class="mes">

        </div>
            
                
            
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
                url:"backend/connect-intro.php",
                method: "POST",
                success: function(data){
                    $(".mes").html(data);
                }
            });
        }
    });
   </script>