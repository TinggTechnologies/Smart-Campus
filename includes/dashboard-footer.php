<script src="js/jquery2.js"></script>
    <script src="./js/profile.js"></script>
    <script src="./assets/js/sweetalert.js"></script>
    
</body>

</html>

<script>
    $(document).ready(function(){

        //hide the image and show the loader
        $('#my-image').hide();
        $('#loader').show();    
        //load the image
        $('#my-image').on('load', function() {
            $('#loader').hide();
            $('#my-image').show();
        });
        $('.menu-toggle .clickme').click(function() {
            $(this).toggleClass('active');
            $('.menu-links').toggleClass('active');
        });

        fetch_user();

        setInterval(function(){
            fetch_user();
            fetch_status();
        }, 5000);

        setInterval(function(){
            fetch_notification();
        }, 1000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-message.php",
                method: "POST",
                success: function(data){
                    $(".mes").html(data);
                }
            });
        }

        function fetch_notification(){
            $.ajax({
                url:"backend/fetch-notification.php",
                method: "POST",
                success: function(data){
                    $(".not").html(data);
                }
            });
        }

        function fetch_status(){
            $.ajax({
                url:"backend/update-last-activity.php",
                method: "POST",
                success: function(data){
                    $(".status").html(data);
                }
            });
        }

 
    });
   </script>
       <script src="js/index.js"></script>