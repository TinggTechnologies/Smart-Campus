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
<style>
    /* CSS for Full-Screen Loader */
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
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
                <label for="fileInput" style="cursor: pointer;"><i class="bi bi-plus-lg"></i></label>
                <input type="file" id="fileInput" style="display: none;" accept=".pdf, .docx, image/*">
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
        var shouldShowLoader = false;
        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();


        fetch_student_chat();

        setInterval(function(){
            fetch_student_chat();
        }, 1000);

        $(document).on('change', '#fileInput', function (e) {
    var fileName = e.target.files[0].name;
    var currentMessage = $('#message').val();
    $('#message').val(currentMessage + ' ' + fileName);
});

function fetch_student_chat() {
        $.ajax({
            url: "backend/fetch-chat.php",
            type: "POST",
            data: {
                outgoing_id: outgoing_id,
                incoming_id: incoming_id,
                message: message
            },
            beforeSend: function () {
                // Show full-screen loader only when shouldShowLoader is true
                if (shouldShowLoader) {
                    $('body').append('<div class="loader-container"><div class="loader"></div></div>');
                }
            },
            success: function (data) {
                console.log("Success Response:", data); // Log the response to the console
                if (data.trim() !== '') {
                    // Hide full-screen loader and update content after successful response
                    $('.loader-container').remove();
                    $('.chats').html(data);

                    // Scroll to the bottom of the chats container
                    $('.chats').scrollTop($('.chats')[0].scrollHeight);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error Response:", jqXHR.responseText);
                // Handle error if needed
                $('.loader-container').remove();
                $('.chats').html('<div class="text-danger">Error loading messages</div>');
            }
        });
    }

    $(document).on('click', '#chat_btn', function (e) {
        e.preventDefault();

        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();

        if (message == "") {
            Swal.fire(
                'Invalid',
                'Enter a message',
                'error'
            )
        } else {
            var formData = new FormData();
            formData.append('file', $('#fileInput')[0].files[0]);
            formData.append('outgoing_id', outgoing_id);
            formData.append('incoming_id', incoming_id);
            formData.append('message', message);

            // Set shouldShowLoader to true when sending a message
            shouldShowLoader = true;

            $.ajax({
                url: 'backend/get-chat.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // Hide full-screen loader and update content after successful response
                    $('.loader-container').remove();
                    $('.chats').html(data);

                    // Scroll to the bottom of the chats container
                $('.chats').scrollTop($('.chats')[0].scrollHeight);
                },
                error: function () {
                    // Handle error if needed
                    $('.loader-container').remove();
                    $('.chats').html('<div class="text-danger">Error sending message</div>');
                },
                complete: function () {
                    // Reset shouldShowLoader after sending the message
                    shouldShowLoader = false;
                    // Reset file input and message input
                    $('#fileInput').val('');
                    $('#message').val('');
                    $('#chat_form')[0].reset();
                    // Fetch the chat after sending the message
                    fetch_student_chat();
                }
            });
        }
    });
});                              
</script>