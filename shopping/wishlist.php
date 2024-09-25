<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>  

<?php 


    if(isset($_POST['submit'])) {

            
        $prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $prod_image = $_POST['prod_image'];
        $prod_price = $_POST['prod_price'];      
        $user_id = $_POST['user_id'];
        
        $insert = $conn->prepare("INSERT INTO wishlist (prod_id, prod_name, prod_image,
        prod_price, user_id) VALUES(:prod_id, :prod_name, :prod_image,
        :prod_price, :user_id)");

        $insert->execute([
            ':prod_id' => $prod_id,
            ':prod_name' => $prod_name,
            ':prod_image' => $prod_image,
            ':prod_price' => $prod_price,
            ':user_id' => $user_id,
        ]);



    }


?>