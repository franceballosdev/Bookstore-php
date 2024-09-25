<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 

<?php
    if(!isset($_SESSION['admin_name'])) {
        header('location: '.ADMINURL. "/admins/login-admins.php");     
    }

    $select = $conn->query("SELECT * FROM products");
    $select->execute();

    $products = $select->fetchAll(PDO::FETCH_OBJ);


?>



    <div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px;">
        <div class="row">
            <div class="col">
            <h1 class="text-center mb-5">List showing all products</h1>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title mb-4 d-inline">Products</h3>
                        <a href="<?php echo ADMINURL; ?>/products-admins/create-products.php" 
                        class="btn btn-dark text-light mb-4 float-end btn-lg rounded-pill" 
                        style="background-color: #020122;">
                        Create Products</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <th scope="row"><?php echo $product->id; ?></th>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $product->price; ?></td>
                                        <td><?php echo $product->category; ?></td>
                                        <?php 
                                        $btnClass = ($product->status == 1) ? 'btn-success' : 'btn-danger'; 
                                        $btnText = ($product->status == 1) ? 'Available' : 'Not Available'; 
                                        ?>
                                        <td>
                                            <a href="<?php echo ADMINURL; ?>/products-admins/status.php?id=<?php echo $product->id; ?>&status=<?php echo $product->status; ?>" 
                                            class="btn <?php echo $btnClass; ?> rounded-pill w-50" style="min-width:120px;">
                                            <?php echo $btnText; ?></a>
                                        </td>
                                        <td>
                                            <!-- Modal triggered by a button -->
                                            <button type="button" 
                                            class="btn btn-danger text-center rounded-pill" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteProduct<?php echo $product->id; ?>">
                                            Delete</button>

                                            <!-- Modal -->
                                            <div class="modal fade" 
                                            id="deleteProduct<?php echo $product->id; ?>" 
                                            tabindex="-1" 
                                            aria-labelledby="exampleModalLabel" 
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                        id="exampleModalLabel">Delete Product</h5>
                                                        <button type="button" 
                                                        class="btn-close rounded-pill" 
                                                        data-bs-dismiss="modal" 
                                                        aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this product? 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" 
                                                        class="btn btn-secondary rounded-pill" 
                                                        data-bs-dismiss="modal">Close</button>
                                                        <a href="<?php echo ADMINURL; ?>/products-admins/delete-products.php?id=<?php echo $product->id; ?>" 
                                                        class="btn btn-danger text-center rounded-pill">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer.php"; ?>