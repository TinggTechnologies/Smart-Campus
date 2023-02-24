<?php require_once "includes/dashboard-header.php"; ?>

<body>

    <section class="follow-wrapper">
        <header class="d-flex-sb">
            <a href="javascript:history.back()"><i class="bi bi-arrow-left"></i></a>
            <h3><?= $_SESSION['lastname']; ?></h3>
            <a href="#"><i class="bi bi-person-plus"></i></a>
        </header>
        
        <nav class="d-flex-sa">
            <a href="#" class="active" style="background-color: transparent;">Friend Request</a>
            <a href="following.php">Sent Request</a>
        </nav>

        <div class="followers">
        
           
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
                url:"backend/friend-request.php",
                method: "POST",
                success: function(data){
                    $(".followers").html(data);
                }
            });
        }

       
    });
   </script>