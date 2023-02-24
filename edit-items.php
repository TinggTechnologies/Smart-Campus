<?php
require_once "includes/dashboard-header.php"; 

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
?>  

<body>
    <style>
        .feed{
            margin-top: 2rem;
        }
        .feed-wrapper p{
            font-size: 1.6rem;
        }
        h5{
            font-size: 1.6rem;
            line-height: 1.5;
            font-weight: 700;
        }
        h5 span{
            opacity: .7;
        }
        #assignment-pdf, .assignment-pdf{
            background-color: rgb(214, 78, 101);
            padding: 1rem 3rem;
            color: #fff;
            border-radius: 25px;
        }
      .l1{
        background: rgb(151, 51, 51);
        padding: 4rem 2rem;
      }
      .l1 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l1 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l2{
        background: rgb(50, 114, 50);
        padding: 4rem 2rem;
      }
      .l2 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l2 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l3{
        background: rgb(95, 95, 153);
        padding: 4rem 2rem;
        margin-top: 2rem;
      }
      .l3 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l3 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      .l4{
        background: rgb(148, 78, 90);
        padding: 4rem 2rem;
        margin-top: 2rem;
      }
      .l4 h4{
        font-size: 1.6rem;
        color: #fff;
        font-weight: 700;
      }
      .l4 p{
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
      }
      
    </style>

    <section class="container-fluid index-wrapper" style="margin-bottom: 5rem;">
       <?php require_once "includes/business-nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav-no.php"; ?>
        <!-- End Navigation -->

        <!-- ================= Feeds ================== -->

          <div class="assignment" style="width: 90%; margin: auto;">

          <div style="margin-top: 3rem;">
          <h3 class="text-center">Edit Items</h3>
            
            
            <div class="assignment-student" style="padding-bottom: 4rem; padding-top: 3rem;">

           
            </div>


          </div>
        </div>


    </section>
</body>

<?php require_once "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/edit-items.php",
                method: "post",
                success: function(data){
                    $(".assignment-student").html(data);
                }
            });
        }

       
       
    });
   </script>