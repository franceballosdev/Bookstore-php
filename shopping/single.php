<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>

<?php

    if(isset($_POST['submit'])) {
        $prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $prod_image = $_POST['prod_image'];
        $prod_price = $_POST['prod_price'];
        $prod_amount = $_POST['prod_amount'];
        $prod_file = $_POST['prod_file'];
        $user_id = $_POST['user_id'];

        $insert = $conn->prepare("INSERT INTO cart (prod_id, prod_name, prod_image, prod_price, prod_amount, prod_file, user_id) 
        VALUES (:prod_id, :prod_name, :prod_image, :prod_price, :prod_amount, :prod_file, :user_id)");

        $insert->execute([
            ":prod_id" => $prod_id,
            ":prod_name" => $prod_name,
            ":prod_image" => $prod_image,
            ":prod_price" => $prod_price,
            ":prod_amount" => $prod_amount,
            ":prod_file" => $prod_file,
            ":user_id" => $user_id,
        ]);

    }
        

    if(isset($_GET['id'])) {
        $id = $_GET['id'];


        if(isset($_SESSION['user_id'])) {
        $select = $conn->query("SELECT * FROM cart WHERE prod_id = '$id' AND user_id = '$_SESSION[user_id]'");
        $select->execute();
        }

        if(isset($_SESSION['user_id'])) {
            $select_wishlist = $conn->query("SELECT * FROM wishlist WHERE prod_id = '$id' AND user_id='$_SESSION[user_id]'");
            $select_wishlist->execute();
    
            $fetch = $select_wishlist->fetch(PDO::FETCH_OBJ);
        }

        $row = $conn->query("SELECT * FROM products WHERE status = 1 AND id = $id");
        $row->execute();

        $product = $row->fetch(PDO::FETCH_OBJ);


    } else {
        header("Location: ".APPURL."/404.php");
    }



    ?>
<div class="container" style="font-family: 'Fira Sans', sans-serif">
    <div class="row justify-content-center mt-5 mb-5"  style="margin-bottom: 100px">
        <div class="col-md-10">
            <div class="shadow rounded-4" style="background-color: white">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3 text-center">
                            <img id="main-image" src="<?php echo APPURL . '/images/' . htmlspecialchars($product->image, ENT_QUOTES); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES); ?>"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="justify-content-between align-items-center mb-4">
                                <a href="<?php echo APPURL; ?>" class="ml-1 btn btn-dark rounded-pill" style="background-color: #0D0630;"> <i class="fa fa-long-arrow-left"></i> Back</a> 
                            </div>
                            <h5 class="text-uppercase"><?php echo htmlspecialchars($product->name, ENT_QUOTES); ?></h5>
                            <div class="price mb-4 flex-row align-items-center"> 
                                <span class="act-price"><?php echo htmlspecialchars($product->price, ENT_QUOTES); ?>$ per item</span>
                            </div>
                            <p class="about mb-4"><?php echo htmlspecialchars($product->description, ENT_QUOTES); ?></p>
                            <?php if(isset($_SESSION['user_id'])) : ?>
                                <?php if($select->rowCount() > 0) : ?>
                                    <button id="submit" name="submit" type="submit" disabled class="btn btn-dark text-uppercase mr-2 px-4 rounded-pill" style="background-color: #0D0630;"><i class="fas fa-shopping-cart"></i> Already added to cart</button> 
                                <?php else : ?>
                                    <form method="post" id="cart-form" action="">
                                        <input type="hidden" name="prod_id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES); ?>">
                                        <input type="hidden" name="prod_name" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES); ?>">
                                        <input type="hidden" name="prod_image" value="<?php echo htmlspecialchars($product->image, ENT_QUOTES); ?>">
                                        <input type="hidden" name="prod_price" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES); ?>">
                                        <input type="hidden" name="prod_amount" value="1">
                                        <input type="hidden" name="prod_file" value="<?php echo htmlspecialchars($product->file, ENT_QUOTES); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'], ENT_QUOTES); ?>">
                                        <button id="submit" name="submit" type="submit" class="btn btn-dark text-uppercase mr-2 px-4 rounded-pill" style="background-color: #0D0630;" data-toggle="modal" data-target="#myModal">
                                            <i class="fas fa-shopping-cart"></i> Add to cart
                                        </button>
                                        <?php if($select_wishlist->rowCount() > 0) : ?>
                                            <button class="delete-wishlist btn btn-dark text-uppercase mr-2 px-4 rounded-pill" style="background-color: #0D0630;" data-id="<?php echo $fetch->id; ?>"><i class="fas fa-trash"></i> Remove from wishlist</button>
                                        <?php else : ?>    
                                            <button class="wishlist-btn btn btn-dark text-uppercase mr-2 px-4 rounded-pill" style="background-color: #0D0630;" data-id="<?php echo $product->id; ?>"><i class="fas fa-heart"></i> Add to wishlist</button>
                                        <?php endif; ?>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <h5 id="modal-message"></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark rounded-pill btn-lg w-100" data-bs-dismiss="modal" style="background-color: #0D0630;" onclick="window.location.reload()">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>

<script>
    $(document).ready(function() {        
        $(document).on("submit", "#cart-form", function(e) {
            e.preventDefault();
            var formData = $(this).serialize() + '&submit=submit';

            $.post("single.php?id=<?php echo $id; ?>", formData, function() {
                $("#submit").html("<i class='fas fa-shopping-cart'></i> Added to cart").prop("disabled", true);
                $("#modal-message").html("Product added to the shopping cart");
                $("#myModal").modal("show");
                //refreshPage();
            });
        });

        function refreshPage() {
            $("body").load("single.php?id=<?php echo $id; ?>");
        }

        $(document).on("click", ".wishlist-btn", function(e) {
            e.preventDefault();
            var formDatas = $("#cart-form").serialize() + '&submit=submit';

            $.ajax({
                method: "POST",
                url: "wishlist.php",
                data: formDatas,
            }).done(function() {
                $("#wishlist-btn")
                    .html("<i class='fas fa-heart'></i> Added to wishlist")
                    .addClass("btn-delete-wishlist")
                    .removeClass("wishlist-btn");
                $("#modal-message").html("Product added to the wishlist");
                $("#myModal").modal("show");
                //refreshPage();
            });
        });

        $(document).on("click", ".delete-wishlist", function(e) {
            e.preventDefault();
            var id = $(this).data("id");

            $.ajax({
                method: "POST",
                url: "wishlist-delete.php",
                data: { delete: "delete", id: id },
            }).done(function() {
                $("#wishlist-btn")
                    .html("<i class='fas fa-heart'></i> Add to wishlist")
                    .addClass("wishlist-btn")
                    .removeClass("btn-delete-wishlist");
                $("#modal-message").html("Product removed from the wishlist");
                $("#myModal").modal("show");
                //refreshPage();
            });
        });
    });
</script>

