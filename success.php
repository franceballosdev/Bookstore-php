<?php require "includes/header.php"; ?>
<?php
            if(!isset($_SERVER['HTTP_REFERER'])){
                header("Location: index.php");
                exit;
            }
?>
<?php header ("refresh:5; url=index.php"); ?>
<div class="container">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">Payment Successful</h1>
                <p class="lead mb-5">
                    Thank you for shopping with us. Go ahead and check your email for the items you ordered.
                </p>
                <p>You will be redirected in 5 seconds</p>
                <a href="index.php" class="btn btn-dark btn-lg px-4 gap-3 rounded-pill" style="background-color: #0D0630;">Go Home</a>
            </div>
        </div>
</div>
<?php require "includes/footer.php"; ?>