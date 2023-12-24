<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
//date_default_timezone_set('Africa/Lagos');
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}


$rm_sql = "SELECT * FROM users WHERE user_id=? AND (department='' OR school='' OR faculty='')";
$rm_stmt = $conn->prepare($rm_sql);
$rm_stmt->bind_param('s', $id);
if($rm_stmt->execute()){
   $rm_result = $rm_stmt->get_result();
   if($rm_result->num_rows > 0){
    echo "<script>location.href = 'verify-email.php';</script>"; 
   }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/easylearn/logo4.png" rel="icon">
    <link href="./assets/img/easylearn/logo4.png" rel="apple-touch-icon">

    <title>EazyLearn</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body>
<style>
    p{
        font-size: 1.4rem;
    }
    .chat-box{
        position: fixed;
        left: 0;
        right: 0;
        bottom: 10;
    }
    header{
        align-items: center;
    }
  
</style>
<?php
$incoming_id = $_SESSION['id'];
if(isset($_GET['id'])){
    $outgoing_id = $_GET['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $outgoing_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc(); 
        }
    }
?>
    <section class="container-fluid index-wrapper">
        <header class="d-flex-sb" style="padding-bottom: 2.5rem;">
            <a href="javascript:history.back()"><i class="bi bi-arrow-left"></i></a>
            <img src="uploads/<?= $rows['image']; ?>">
            <h3><a href="friends-profile.html"><?= $rows['lastname'] .' '. $rows['firstname']; ?></a></h3>
            <i class="bi bi-three-dots-vertical notifications"></i>
        </header>

        <div class="chat-wrapper" style="margin-top: 2rem;">

            <div class="chats" style="overflow-y: auto;">
                
            </div>

            <form id="chat_form">
            <div class="say-something chat-box">
                <div class="add-icon">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <div class="write-something cb-ws">
                    <input type="text" class="form-control" id="message" placeholder="Enter a message">
                    <input type="hidden" class="form-control" id="outgoing_id" value="<?= $outgoing_id; ?>">
                    <input type="hidden" class="form-control" id="incoming_id" value="<?= $incoming_id; ?>">
                </div>
                <div class="add-emoji cb">
                    <i class="bi bi-emoji-smile"></i>
                    <i id="chat_btn" class="bi bi-send cb-send"></i>
                </div>
            </div>
            </form>

        </div>
    </section>

   <?php require "includes/dashboard-footer.php"; ?>

<script>
    $(document).ready(function(){

        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();


        fetch_student_chat();

        setInterval(function(){
            fetch_student_chat();
        }, 1000);

        function fetch_student_chat(){
            $.ajax({
                url: "backend/fetch-chat.php",
                type: "POST",
                data:
                {
                    outgoing_id: outgoing_id,
                    incoming_id: incoming_id,
                    message:message
                },
                success:function(data){
                    $('.chats').html(data);
                }
            });
        }

    $(document).on('click', '#chat_btn', function(e){
        e.preventDefault();

        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();

        if(message == ""){
            Swal.fire(
            'Invalid',
            'Enter a message',
            'error'
          )
            }
        else{
            $.ajax({
                url: 'backend/get-chat.php',
                type: 'post',
                data:
                {
                    outgoing_id: outgoing_id,
                    incoming_id: incoming_id,
                    message:message,
                },
                success: function(data){
                    $('.chats').html(data);
                    
                }
            });
            $('#chat_form')[0].reset();
        }
    });
});                              
</script>