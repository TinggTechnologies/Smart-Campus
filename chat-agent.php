<?php require "includes/dashboard-header.php"; ?>
<body>
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

    <section class="index-wrapper chat">
        <header class="top d-flex-sb">
            <a href="javascript:history.back()"><i class="bi bi-chevron-left"></i></a>
            <div class="d-flex-sb chat-top">
                <img src="uploads/<?= $rows['image']; ?>" style="margin-left: 1rem;">
                <h3><a href="friends-profile.html"><?= $rows['lastname'] .' '. $rows['firstname']; ?></a></h3>
            </div>
            <i class="bi bi-three-dots-vertical notifications"></i>
        </header>

        <div class="chat-wrapper" style=" padding-bottom: 8rem;">

            <div class="chats">
                
                
               
            </div>

            <form id="chat_form">
            <div class="type-message d-flex" style="position: fixed; bottom: 0; right: 0; left: 0;">
                <div class="add-icon">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <div class="write-something">
                    <input type="text" class="form-control" id="message" placeholder="Type your message...">
                </div>
                <input type="hidden" class="form-control" id="outgoing_id" value="<?= $outgoing_id; ?>">
                    <input type="hidden" class="form-control" id="incoming_id" value="<?= $incoming_id; ?>">
                <div class="action-icon">
                    <i class="bi bi-send send-message " id="chat_btn"></i>
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
                url: "backend/fetch-agent-chat.php",
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
                url: 'backend/get-agent-chat.php',
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