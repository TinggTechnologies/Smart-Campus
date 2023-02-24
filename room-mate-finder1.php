<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "header.php";
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}

$rm_sql = "SELECT * FROM roommate_finder WHERE user_id='$id'";
$rm_stmt = $conn->prepare($rm_sql);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    $rm_row = $rm_result->fetch_assoc();
    @$room = $rm_row['user_id'];
   }
}

if(@$room == $id){
    echo "<script>location.href = 'room-mate-finder6.php';</script>"; 
}

?>

<body>
    <section class="container-fluid login-wrapper pt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
                <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Room Mate Finder</a>
            <img src="./assets/img/easylearn/intro4.jpg" style="border-radius: 10px;" class="pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Which One Are You?</h2>
                <span style="color: blue; font-weight: 500; font-size: 1.3rem;">Step 1 of 5</span>
                <form id="profile_form">
                    <div class="input-group mb-4">
                       <select name="profile" id="profile" class="form-control">
                         <option value="">which one are you?</option>
                         <option value="Moving Into An Apartment And Looking For Roommates To Join You?">Moving Into An Apartment And Looking For Roommates To Join You?</option>
                         <option value="Already Living In An Apartment And Looking For Roommates To Split The Bill?">Already Living In An Apartment And Looking For Roommates To Split The Bill?</option>
                       </select>
                    </div>
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                                        
                    <div class="form-group">
                        <button type="submit" id="room_mate_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
<script>
    $(document).on('click', '#room_mate_btn', function(e){
        e.preventDefault();

        var profile = $('#profile').val(); 
        var user_id = $('#user_id').val();             

        if(profile == ""){
            Swal.fire(
            'Invalid',
            'No field should be empty',
            'error'
          )
        }else {
            $.ajax({
                url: 'backend/room_mate_finder1.php',
                type: 'post',
                data:
                {
                    profile: profile,
                    user_id:user_id
                },
                success: function(response){
                    location.href = "room-mate-finder2.php";
                                 
                }
            });
            $('#profile_form')[0].reset();
        }
    });
</script>