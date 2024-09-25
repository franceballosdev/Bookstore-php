<?php require 'includes/header.php'; ?>   
<?php require 'config/config.php'; ?>
<?php

        $rows = $conn->query("SELECT * FROM products WHERE status = 1");
        $rows->execute();

        $allRows = $rows->fetchAll(PDO::FETCH_OBJ);

        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $rows = $conn->query("SELECT * FROM products WHERE status = 1 AND name LIKE '%{$search}%'");
            $rows->execute();
            $allRows = $rows->fetchAll(PDO::FETCH_OBJ);
        }
 ?>
<div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px; margin-top: 100px;">
    <form action="index.php" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search products" aria-label="Search products" aria-describedby="button-addon2">
            <button class="btn btn-secondary btn-lg" style="background-color: #0D0630; border-radius: 0 1rem 1rem 0  ;" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
    <div class="row mt-5" style="margin-bottom: 100px">
        <?php foreach ($allRows as $product): ?>
            <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mb-4">
                 <div class="card h-100 rounded-4 shadow border-0 animate-fade-in">
                    <img 
                            class="card-img-top "
                            src="<?php echo APPURL; ?>/images/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                            style="height: 213px; object-fit: cover;" 
                            alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                            >
                            <div class="card-body d-flex flex-column">
                            <h5 class="d-inline"><b><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></b></h5>
                            <h5 class="d-inline text-muted">
                            <div>(<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>$/item)</div>
                            </h5>
                            <p class="text-truncate" style="max-width: 100%;"><?php echo htmlspecialchars(substr($product->description, 0, 200), ENT_QUOTES, 'UTF-8'); ?></p>
                            <a 
                            href="<?php echo APPURL; ?>/shopping/single.php?id=<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>" 
                            class="btn btn-dark w-100 rounded-pill my-2" style="background-color: #0D0630;"
                        >
                            See more
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php require 'includes/footer.php'; ?>
