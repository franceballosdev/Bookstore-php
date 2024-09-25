<?php 

  session_start();

  define("ADMINURL", "http://localhost/bookstore/admin-panel");
  define("APPURL", "http://localhost/bookstore");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="margin-top: 100px; font-family: 'Fira Sans', sans-serif; margin-left: 200px;">
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-light navbar-expand-lg" style="background-color: #020122">
      <div class="container">
      <a class="navbar-brand text-white" href="<?php echo ADMINURL; ?>">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
      <?php if(isset($_SESSION['admin_name'])) : ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav flex-column side-nav" style="width: 250px; position: fixed; top: 0; left: 0; background-color: #020122; z-index: 9999; height: 100%; overflow-y: auto;margin-top: 60px">
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3 mt-5" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>">Home
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>/admins/admins.php" style="margin-left: 20px;">Admins</a></li>
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>/categories-admins/show-categories.php" style="margin-left: 20px;">Categories</a></li>
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>/products-admins/show-products.php" style="margin-left: 20px;">Products</a></li>
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>/products-admins/show-orders.php">Orders</a></li>
                <li class="nav-item"><a class="btn btn-secondary w-100 btn-lg mb-3" style="background-color: #020122; width: 100%; min-height: 45px;" href="<?php echo ADMINURL; ?>/users-admins/show-users.php">Users</a></li>
            </ul>
        </div>
        <div style="margin-left: 300px;">
        <?php endif; ?>
        <ul class="navbar-nav ml-md-auto d-md-flex">

        <?php if(!isset($_SESSION['admin_name'])) : ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://localhost/bookstore/">Go to main page</a>
            </li>
          <?php else : ?>
            
            <li class="nav-item dropdown">
              <button class="btn btn-secondary nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['admin_name']; ?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo ADMINURL; ?>/admins/logout-admins.php">Logout</a></li>
              </ul>
            </li>

          <?php endif; ?>
                          
          
        </ul>
      </div>
    </div>
    </nav>