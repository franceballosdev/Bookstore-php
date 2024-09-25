<?php

require '../includes/header.php';
require '../config/config.php';

if (!isset($_SESSION['username'])) {
    header('location: ' . APPURL . "");
}

$userId = $_SESSION['user_id'];
$select = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?");
$select->execute([$userId]);

$wishlists = $select->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px; margin-top: 100px">
    <div class="row mt-5 mb-5">
        <div class="col">
            <?php if (!empty($wishlists)): ?>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center d-inline">My wishlist</h3>
                        <table class="table mb-5 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Date added to wishlist</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($wishlists as $wishlist): ?>
                                <tr>
                                    <th scope="row"><?= $wishlist->id ?></th>
                                    <td><img width="100" height="100" src="../images/<?= $wishlist->prod_image ?>" class="img-fluid rounded-4" alt="Cotton T-shirt"></td>
                                    <td><?= $wishlist->prod_name ?></td>
                                    <td><?= $wishlist->prod_price ?> $</td>
                                    <td><?= $wishlist->created_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h1 class="card-title d-inline">There are no products in your wishlist</h1>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>
