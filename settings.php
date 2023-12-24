<?php require "includes/dashboard-header.php"; ?>

<body>

    <section class="settings-wrapper">
        <nav class="settings-nav d-flex-sb">
            <a href="javascript:history.back();"><i class="bi bi-arrow-left back"></i></a>
            <h4>Settings and Privacy</h4>
            <span class="settings-dropper"><i class="bi bi-three-dots-vertical"></i></span>
            <div class="setting-dropdown">
                <h4 class="text-center">Switch Mode</h4>
                <li class="d-flex-sb"><i class="bi bi-moon"></i> Dark Mode <i class="bi bi-toggle-off switch-mode"></i></li>
                <!-- <li class="d-flex-sb"><i class="bi bi-sun"></i> Light Mode <i class="bi bi-toggle-on switch-mode"></i></li> -->
            </div>
        </nav>
        
        <div class="container-fluid settings-body">
            <ul>
                <a href="edit-profile.php"><li><i class="bi bi-person-plus"></i> Edit Profile</li></a>
                <a href="change-password.php"><li><i class="bi bi-lock"></i> Change Password</li></a>
                <a href="chat-agent.php?id=admin"><li><i class="bi bi-pen"></i> Report a problem</li></a>
                <a href="chat-agent.php?id=admin"><li><i class="bi bi-chat"></i> Chat with us</li></a>
                <a href="privacy.php"><li><i class="bi bi-file-earmark"></i> Privacy Policy</li></a>
                <a href="bank-account.php"><li><i class="bi bi-house"></i> Bank Account</li></a>
                <a href="logout.php"><li><i class="bi bi-box-arrow-in-right"></i> Logout</li></a>
                <hr>
                <a href="#"><li class="delete-account" style="border-radius: 25px; background: blue;"><i class="bi bi-trash-fill"></i> Delete Account</li></a>
            </ul>
        </div>

        <div class="footer" style="margin-top: 3rem;">
            <p class="text-center" style="font-family:'san-serif'; font-size: 2rem;">Smartcampus &copy; 2023</p>
        </div>

    </section>

<?php require "includes/dashboard-footer.php"; ?>