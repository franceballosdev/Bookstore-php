<?php  require '../includes/header.php'; ?>
<?php  require '../config/config.php'; ?>

<?php

    if(!isset($_SESSION['username'])) {
        header('location: '.APPURL. "");     
    }

    if($_GET['id'] != $_SESSION['user_id']) {
        header('location: '.APPURL. "/users/orders.php?id={$_SESSION['user_id']}");
    }

    $select = $conn->query("SELECT * FROM orders WHERE user_id = '{$_SESSION['user_id']}'");
    $select->execute();

    $orders = $select->fetchAll(PDO::FETCH_OBJ);


?>

    <div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px; margin-top: 100px">
        <div class="row mt-5 mb-5">
            <div class="col">
                <?php if(!empty($orders)): ?>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title d-inline">My orders</h3>
                        <table class="table mb-5 table-hover">
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