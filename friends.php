<?php require_once "includes/dashboard-header.php"; ?>

<body>

    <section class="follow-wrapper">
        <header class="d-flex-sb">
            <a href="javascript:history.back()"><i class="bi bi-arrow-left"></i></a>
            <h3><?= $_SESSION['lastname']; ?></h3>
            <a href="followers.php"><i class="bi bi-person-plus"></i></a>
        </header>
        
        <nav class="d-flex-sa">
            <a href="#">People you may know</a>
        </nav>

        <div class="followers">
        
           
        </div>
    </section>

    <?php require_once "includes/dashboard-footer.php"; ?>

    <script>
    $(document).ready(function(){
        fetch_user();

            fetch_user();

        function fetch_user(){
            $.ajax({
                url:"backend/followers.php",
                method: "POST",
                success: function(data){
                    $(".followers").html(data);
                }
            });
        }

       
    });
   </script>