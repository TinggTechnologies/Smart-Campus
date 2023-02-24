<?php require_once "includes/dashboard-header.php"; ?>

<?php
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
    }
}

?>

<body>

    <section class="friends-profile-wrapper">
        <nav class="top-nav bg-2 d-flex-sb">
            <a href="javascript:history.back();"><i class="bi bi-arrow-left"></i></a>
            <span><i class="bi bi-three-dots-vertical"></i></span>
        </nav>

        <div class="container-fluid friends-profile">
            
            <div class="person-info">
                <img src="<?= $rows['image'] ?>">
                <h3><?= $rows['lastname'] .' '.$rows['firstname']; ?></h3>
                <p style="font-weight: bolder; opacity: 1;"><?= $rows['school']; ?></p>
                <p style="color: blue;"><?= $rows['department']; ?> <span style="color: #030a23;">#<?= $rows['faculty']; ?></span></p>
            </div>

            <hr>
         
            <div class="action text-center">
                <p><?= $rows['lastname']; ?> is a student of <?= $rows['school']; ?> from the department of <?= $rows['department']; ?>. you can accept the friend's request below.</p>
                <button class="btn btn-primary" style="padding: 1.2rem 3rem; margin-top: 1rem;" id="add_friend_btn">Accept Friend</button>
               
                <form id="add_friend_form">
                    <input type="hidden" id="user_id" value="<?= $id; ?>">
                    <input type="hidden" id="friend_id" value="<?= $user_id; ?>">
                </form>
            </div>

            
        </div>

    </section>

   <?php require "includes/dashboard-footer.php"; ?>
   <script>
    $(document).ready(function(){
   
    $(document).on('click', '#add_friend_btn', function(e){
        e.preventDefault();

        var friend_id = $('#friend_id').val();
        var user_id = $('#user_id').val();

            $.ajax({
                url: 'backend/accept-request.php',
                type: 'post',
                data:
                {
                    friend_id: friend_id,
                    user_id:user_id
                },
                success: function(data){
                    location.href = "following.php";
                    
                }
            });
            $('#add_friend_form')[0].reset();
        
    });

});                              
</script>

   
  