<?php require "includes/dashboard-header.php"; ?>
<body>

    <section class="index-wrapper" style="padding-top: 9rem;">
        <?php require "includes/nav.php"; ?>
        <?php require "includes/footer-nav-notification.php"; ?>
        <div class="notification-wrapper" style="margin-top: 1rem;">


            
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){

        update_notification();

        setInterval(function(){
            update_notification();
        }, 1000);

        function update_notification(){
            $.ajax({
                url: "backend/update-notification.php",
                type: "POST",
                success:function(data){
                    $('.notification-wrapper').html(data);
                }
            });
        }

    
});                              
</script>