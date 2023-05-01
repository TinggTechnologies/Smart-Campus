<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id']; 
}

$sql = "SELECT * FROM sell WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $item_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}


require "backend/edit-item.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicons -->
    <link href="assets/img/easylearn/logo4.png" rel="icon">
    <link href="assets/img/easylearn/logo4.png" rel="apple-touch-icon">

    <title>Eazy Learn</title>
    <link rel="stylesheet" href="./vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/query.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="row justify-content-center ">
                <div class="col-lg-6">
                    <div class="login-form">
                        <div class="logo text-danger"><a href="javascript:history.back();" style="font-size: 1.6rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> </a></div>
                            <h2 class="pt-3" style="color: blue;">Upload Items</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group text-center">
                                <div class="message">
                                <?php 
                           if(isset($error['file'])){
                            echo $error['file'];
                           }
                        ?>
                                </div>
                            </div>
                                <div class="input-group mb-4">
                                    <input type="text" name="item_name" id="item_name" class="form-control" value="<?= $row['item_name']; ?>" >
                                </div>

                                <div class="input-group mb-4">
                                    <input type="text" name="price" id="price" class="form-control" value="<?= $row['price']; ?>" >
                                </div>

                                <div class="input-group mb-4">
                                    <select name="category" id="category" class="form-control">

                                        <option value="<?= $row['category']; ?>"><?= $row['category']; ?></option>
                                        <option value="Food and Snacks">Food and Snacks</option>
                                        <option value="Drinks">Drinks</option>
                                        <option value="Groceries">Groceries</option>
                                        <option value="Gadgets">Gadgets</option>
                                        <option value="Home Accessories">Home Accessories</option>
                                        <option value="Wears and Jewelries">Wears and Jewelries</option>
                                        <option value="Beaulty and Health">Beaulty and Health</option>
                                        <option value="Books">Books</option>
                                    </select>
                                </div>
            
                                <div class="mb-4" >  
                                    <a href="edit-item-image.php?item_id=<?= $item_id; ?>"><img src="uploads/<?= $row['image']; ?>" style="max-width: 100%" alt=""></a>
                                </div>

                                <input type="hidden" name="item_id" id="item_id" value="<?= $item_id; ?>">
            
                                <div class="form-group mt-5">
                                    <button type="submit" name="donate-pdf-btn" id="donate-pdf-btn" class="form-control getStarted-btn">Edit Item</button>
                                </div>
                                
                            </form>
                            
                        </div>
                </div>
            </div>
            
            
        </div>
    </section>
    <script src="js/jquery2.js"></script>
    <script src="js/index.js"></script>
    <script src="./assets/js/sweetalert.js"></script>
</body>
    </html>
    