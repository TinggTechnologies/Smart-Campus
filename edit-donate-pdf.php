<?php require "includes/dashboard-header.php"; ?>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 13rem;">

        <?php require "includes/nav.php"; ?>
        <?php require "includes/footer-nav.php"; ?>

        <div class="search-wrapper">
            <div class="search-result"></div>
        </div>
    </section>

<?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
      
        fetch_pq ();

        setInterval(function(){
            fetch_pq ();
        }, 1000);

       function fetch_pq (){
        

            $.ajax({
                url:"backend/edit-donate-pdf.php",
                method: "POST",
                success: function(data){
                    $(".search-result").html(data);
                }
            });

    };
});
       

   </script>