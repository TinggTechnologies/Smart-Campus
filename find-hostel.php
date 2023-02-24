<?php require "includes/dashboard-header.php"; ?>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem;">

        <?php require "includes/nav.php"; ?>
        <?php require "includes/footer-nav-no.php"; ?>
        <div>
        <p style="font-size: 1.7rem;">Property for sale, property for rent, and short-let rentals in any school. Find house, flat, apartment, short-let, self-contain, land, and commercial properties for rent and sale in any school. </p>
        </div>

        <div class="search-wrapper" style="margin-top: 2rem;">
            <hr>
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="enter town name..." autocomplete="off" id="search" name="search">
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
                url:"backend/find-hostel.php",
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