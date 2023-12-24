<script src="moyin_js/jquery2.js"></script>
    <script src="./moyin_js/profile.js"></script>
    <script src="./assets/js/sweetalert.js"></script>
    
</body>

</html>

<script>       
    $(document).ready(function(){

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
            fetch_friends_request();
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

        function fetch_friends_request(){
            $.ajax({
                url:"backend/fetch-fr.php",
                method: "POST",
                success: function(data){
                    $(".people").html(data);
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

  $('.post').on('click', function() {
    $(this).find('i').removeClass('fa-plus');
    $(this).find('i').addClass('fa-times');
    $(this).find('i').css('background-color', '#dc3545');
    $(this).find('i').css('box-shadow', '0px 5px 6px rgba(0, 0, 0, 0.1)');
    $(this).find('i').animate({
      width: '80px',
      height: '80px',
      borderRadius: '50%',
      bottom: '10px'
    }); 

});

 
    });
   </script>
       <script src="moyin_js/index.js"></script>