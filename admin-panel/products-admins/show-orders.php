<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 

<?php

    if(!isset($_SESSION['admin_name'])) {
        header('location: '.ADMINURL. "/admins/login-admins.php");     
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $select = $conn->prepare("SELECT * FROM orders WHERE username LIKE ? OR email LIKE ?");
        $select->execute(["%$search%", "%$search%"]);
    } else {
        $select = $conn->query("SELECT * FROM orders");
        $select->execute();
    }

    $orders = $select->fetchAll(PDO::FETCH_OBJ);

?>

    <div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px;">
        <div class="row">
            <div class="col">
                <h1 class="text-center mb-5">List showing all the users orders</h1>
                <form action="show-orders.php" method="GET">
                <div class="d-flex justify-content-end w-100">
                    <div class="input-group mb-3 mt-3 w-50">
                        <input type="text" name="search" class="form-control" placeholder="Search orders by name or email" value="<?= $search ?>">
                        <button type="submit" class="btn btn-dark btn-lg" style="background-color: #020122; border-radius: 0 1rem 1rem 0  ;"> Search </button>
                    </div>
                </div>
                </form>
                <?php if(!empty($orders)): ?>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title d-inline">All orders</h3>
                        <table class="table mb-5 table-hover mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">User id</th>
                                    <th scope="col">Date of order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order): ?>
                                    <tr>
                                        <th scope="row"><?= $order->id ?></th>
                                        <td><?= $order->username ?></td>
                                        <td><?= $order->first_name ?></td>
                                        <td><?= $order->last_name ?></td>
                                        <td><?= $order->email ?></td>
                                        <td><?= $order->price ?> $</td>
                                        <td><?= $order->user_id ?></td>
                                        <td><?= $order->created_at ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                    <div class="card rounded-4 shadow">
                        <div class="card-body">
                            <h1 class="card-title d-inline">There are no orders</h1>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
<?php  require '../includes/footer.php'; ?>