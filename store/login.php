<?php 
session_start();
if(isset($_SESSION['id'])){
  header("location: dashboard.php");
}

require_once "../database/connection.php";

$error = [];

if(isset($_POST['login-btn'])){
    
    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    if(empty($email) || empty($password)){
        $error['err_msg'] = "<div class='alert alert-danger'>Fill in all the fields</div>";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();

        if(password_verify(@$password, @$staff['password'])){
            $_SESSION['id'] = $staff['user_id'];
            $_SESSION['firstname'] = $staff['firstname'];
            $_SESSION['lastname'] = $staff['lastname'];
            $_SESSION['email'] = $staff['email'];
            $_SESSION['telephone'] = $staff['telephone'];
            $_SESSION['code'] = $staff['code'];
            header("location: ../dashboard.php");
            exit();
        } else{
            $error['err_msg'] = "<div class='alert alert-danger'>Wrong Username or Password</div>";
        }
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Smart Campus is an Edu Tech Company which was initiated by Ndunche Joseph Chizaram to make Learning in Africa much easier and to connect different schools together." name="description">
  <meta content="Smartcampus, Smart Campus, SmartCampus, Smart campus in Nigeria" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/easylearn/logo-cut.png" rel="icon">
    <link href="../assets/img/easylearn/logo-cut.png" rel="apple-touch-icon">

    <title>Smart Campus</title>
    <link rel="stylesheet" href="../vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/sweetalert.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/query.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.tinymce-editor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        });
    </script>

</head>


<style>

</style>

<body>
    <div class="row justify-content-center">
        <div class="col-lg-5">
        <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="login-form">
            <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/logo3.jpg" style="border-radius: 5px;" alt=""> 
      </a>
                <h2 class="pt-5">Log in to your account</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group text-center">
                    <div class="message">
                        <?php
                        if(isset($error['err_msg'])){
                            echo $error['err_msg'];
                        }
                        ?>
                    </div>
                </div>
                    <div class="input-group mb-5">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group" style="position: relative;"><a style="position: absolute; right: .3rem; bottom: 3rem;" href="../forgotten-password.php" class="text-primary">Forgotten Password?</a>
                        <button type="submit" name="login-btn" class="form-control getStarted-btn">Log In</button>
                    </div>
                </form>
                <p>Have no account? <a href="../register-names.php" class="text-primary">Sign Up</a></p>
            </div>
            
        </div>
    </section>
        </div>
    </div>
<?php require "../includes/login-footer.php"; ?>