<?php  require '../includes/header.php'; ?>
<?php  require '../../config/config.php'; ?>


<?php
        if(!isset($_SESSION['admin_name'])) {
            header('location: '.ADMINURL. "/admins/login-admins.php");     
        }


    $select = $conn->query("SELECT * FROM categories");
    $select->execute();

    $categories = $select->fetchAll(PDO::FETCH_OBJ);


?>


    <div class="container mt-5">
    <h1 class="text-center mb-5">List of Categories</h1>
        <div class="row">
            <div class="col">
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title mb-4 d-inline">Categories</h3>
                        <a href="<?php echo ADMINURL; ?>/categories-admins/create-category.php" class="btn btn-dark text-light mb-4 float-end btn-lg rounded-pill" style="background-color: #020122;">Create Categories</a>
                        <table class="table mb-5 table-striped table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <th scope="row"><?php echo $category->id; ?></th>
                                        <td><?php echo $category->name; ?></td>
                                        <td><?php echo substr($category->description, 0, 500) . ' ...';?></td>
                                        <td>
                                            <a 
                                                href="<?php echo ADMINURL; ?>/categories-admins/update-category.php?id=<?php echo $category->id; ?>" 
                                                class="btn btn-success text-white text-center rounded-pill"
                                            >Update</a>
                                        </td>
                                        <td>
                                            <!-- Button to Open the Modal -->
                                            <button type="button" class="btn btn-danger text-center rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal<?php echo $category->id; ?>">
                                                Delete
                                            </button>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="deleteCategoryModal<?php echo $category->id; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Category</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete the category <b><?php echo $category->name; ?></b>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger rounded-pill" onclick="location.href='<?php echo ADMINURL; ?>/categories-admins/delete-category.php?id=<?php echo $category->id; ?>'">Yes</button>
                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">No</button>
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

<?php  require '../includes/footer.php'; ?>