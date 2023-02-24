<?php require_once "includes/dashboard-header.php"; ?>
<?php
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
?>

<body>

    <section class="follow-wrapper">
        <header class="d-flex-sb">
            <a href="javascript:history.back()"><i class="bi bi-arrow-left"></i></a>
            <h3><?= $_SESSION['lastname']; ?></h3>
            <a href="#"><i class="bi bi-person-plus"></i></a>
        </header>
        <nav class="d-flex-sa">
            <a href="followers.php">Friends Request</a>
            <a href="#" class="active" style="background-color: transparent;">Sent Request</a>
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
                url:"backend/fetch-following.php",
                method: "POST",
                success: function(data){
                    $(".followers").html(data);
                }
            });
        }
    });
   </script>