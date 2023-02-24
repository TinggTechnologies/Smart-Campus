<?php require_once "includes/dashboard-header.php"; 
require_once "backend/post.php"; ?>
<body>

    <section class="create-post-wrapper">
        <form id="post_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <header class="d-flex-sb">
            <a href="javascript:history.back();"><i class="bi bi-chevron-left"></i></a>
            <h2>Create post</h2>
            <a href="#" class="btn btn-secondary">Post</a>
        </header>
        <div class="create-post-inner">
            <div class="creator-info d-flex">
                <img src="<?= $row['image']; ?>">
                <h4><?= $row['lastname'] . " " . $row['firstname']; ?></h4>
            </div>
            <div class="post-wrapper">
                <hr>
                <div>
                    <div class="text-center">
                        <?php
                        if(isset($error['file'])){
                            echo $error['file'];
                        }
                        ?>
                    </div>
                   <p>Add Image <i class="bi bi-image"></i></p>
                    <input type="file" id="file" name="file"> 
                </div>
                <textarea class="form-control" cols="30" rows="10" name="text" placeholder="What's on your mind?"></textarea>
                <input type="submit" class="btn btn-secondary" name="btn" id="post_btn" value="Post">
            </div>
        </div>
        
        </form>
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>
