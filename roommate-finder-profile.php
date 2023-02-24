<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Easy Learn - Roomate Finder</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/new.css">
</head>

<body>

    <section class="roommate-finder">
        <nav class="top-nav bg-2 d-flex-sb">
            <div class="d-flex">
                <a href="index.html">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h5>Roommate Finder</h5>
            </div>

            <div class="top-nav-profile-pic">
                <a href="#"><img src="img/profile-pic/profile3.jpg"></a>
            </div>
        </nav>

        <div class="container rm-finder-wrapper rmf-profile">
            <div class="sub-header d-flex-sb">
                <a href="#">Roommates <i class="bi bi-people"></i></a>
                <a href="#" class="active">Subletter <i class="bi bi-person"></i></a>
            </div>
            <div class="user-profile">
                <img src="img/profile-pic/profile3.jpg">

                <div class="user-profile-inn text-center">
                    <h3>Joseph</h3>
                    <p>
                        Oye Ekiti <br>
                        Jan 10, 2023 <br>
                        N 65,000
                    </p>
                    <div class="action-btn d-flex-sb">
                        <div class="circle" id="accept"><i class="bi bi-check"></i></div>
                        <div class="circle" id="decline"><i class="bi bi-x"></i></div>
                    </div>
                    <p class="profile-desc">I'm An Aspiring Frontend Developer</p>
                    <div class="d-flex-sa">
                        <input type="button" value="FLATMATE">
                        <input type="button" value="FREELANCER">
                    </div>
                </div>
            </div>

        </div>

    </section>

    <script src="js/jquery2.js"></script>
</body>

</html>