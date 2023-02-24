<?php 
require_once "includes/dashboard-header.php"; 
?>
<body>

    <section class="container-fluid index-wrapper">
        <header class="d-flex-sb">
            <i class="bi bi-search"></i>
            <h2>Search</h2>
            <a href="javascript:history.back();"><i class="bi bi-x chats"></i></a>
        </header>

        <?php require "includes/footer-nav.php"; ?>

        <div class="search-wrapper">
            <hr>
            <div class="search-box d-flex-sb">
                <input type="search" placeholder="Search...">
                <i class="bi bi-search"></i>
            </div>
            <hr>
        </div>
    </section>

    <?php require_once "includes/dashboard-footer.php"; ?>