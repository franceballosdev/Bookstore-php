<?php

    session_start();

    define("APPURL", "http://localhost/bookstore");

    require dirname(dirname(__FILE__)) . "/config/config.php";

    if(isset($_SESSION['user_id'])) {
    $number = $conn->query("SELECT COUNT(*) as num_products FROM cart WHERE user_id='$_SESSION[user_id]'");
    $number->execute();
    $getNumber = $number->fetch(PDO::FETCH_OBJ);
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?php echo APPURL; ?>/includes/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <script src="https://kit.fontawesome.com/5c5946fe44.js" crossorigin="anonymous"></script>
    <title>Bookstore</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfNGtMpAAAAAP_JGn7iZHFG_xt0TUvjzCa9iXhM"></script>


    </head>
  <body style="background-color: #CDCDCD">


    <nav class="navbar navbar-expand-lg" style="background-color: #0D0630; font-family: 'Fira Sans', sans-serif">
        <div class="container">
            <a class="navbar-brand text-white" href="<?php echo APPURL; ?>">
                <h2><i class="fa-solid fa-book"></i> Bookstore</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="<?php echo APPURL; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="<?php echo APPURL; ?>/contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="<?php echo APPURL; ?>/categories/index.php">Categories</a>
                    </li>

                    <?php if(isset($_SESSION['username'])): ?>

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="<?php echo APPURL; ?>/shopping/cart.php">
                                <i class="fas fa-shopping-cart"></i> (<?php echo $getNumber->num_products; ?>)
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo APPURL; ?>/users/orders.php?id=<?php echo $_SESSION['user_id']; ?>">My orders</a></li>
                                <li><a class="dropdown-item" href="<?php echo APPURL; ?>/users/wishlist.php?id=<?php echo $_SESSION['user_id']; ?>">My wishlist</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo APPURL; ?>/auth/logout.php">Logout</a></li>
                            </ul>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo APPURL; ?>/auth/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo APPURL; ?>/auth/register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>