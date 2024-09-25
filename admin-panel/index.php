
<?php require 'includes/header.php'; ?>
<?php require '../config/config.php'; ?>


<?php

    $products = $conn->query("SELECT COUNT(*) as products_count FROM products");
    $products-> execute();
    $allProducts = $products->fetch(PDO::FETCH_OBJ);


    $categories = $conn->query("SELECT COUNT(*) as categories_count FROM categories");
    $categories-> execute();
    $allCategories = $categories->fetch(PDO::FETCH_OBJ);


    $admins = $conn->query("SELECT COUNT(*) as admins_count FROM admins");
    $admins-> execute();
    $allAdmins = $admins->fetch(PDO::FETCH_OBJ);

    $orders = $conn->query("SELECT COUNT(*) as orders_count FROM orders");
    $orders-> execute();
    $allOrders = $orders->fetch(PDO::FETCH_OBJ);



    if(!isset($_SESSION['admin_name'])) {
      header('location: '.ADMINURL. "/admins/login-admins.php");
      
  }

?>


    <!-- admin-panel/index.html -->
    <div class="container mt-5">
    <h1 class="text-center mb-5">Summary</h1>
        <div class="row">
            <?php foreach(array(
                'products' => $allProducts->products_count,
                'categories' => $allCategories->categories_count,
                'admins' => $allAdmins->admins_count,
                'Total Orders' => $allOrders->orders_count
            ) as $title => $count): ?>
                <div class="col-md-4 mb-4">
                    <div class="card rounded-4 shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ucfirst($title) ?></h5>
                            <p class="card-text">Number of <?php echo ucfirst($title) ?>: <?php echo $count ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
          
<?php require 'includes/footer.php'; ?>
