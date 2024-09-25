<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 

<?php
    if(!isset($_SESSION['admin_name'])) {
      header('location: '.ADMINURL. "/admins/login-admins.php");     
      }

      $select = $conn->query("SELECT * FROM categories");
      $select->execute();
      $allCategories = $select->fetchAll(PDO::FETCH_OBJ);


      if(isset($_POST['submit'])) {
        if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['category_id']) || empty($_POST['category'])) {
          echo "<script>alert('one or more inputs are empty');</script>";
        } else {

          $name = $_POST['name'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          $image = $_FILES['image']['name'];
          $file = $_FILES['file']['name'];
          $category_id = $_POST['category_id'];
          $dir_img = "../../images/" . basename($image);
          $dir_fil = "../../books/" . basename($file);

          $insert = $conn->prepare("INSERT INTO products (name, description, price, category, image, file, category_id) VALUES 
          (:name, :description, :price, :category, :image , :file, :category_id)");
          $insert->execute([
            ":name" => $name,
            ":description" => $description,
            ":price" => $price,
            ":category" => $category,
            ":image" => $image,
            ":file" => $file,
            ":category_id" => $category_id
          ]);

          if(move_uploaded_file($_FILES['image']['tmp_name'], $dir_img) && move_uploaded_file($_FILES['file']['tmp_name'], $dir_fil)) {
            header('Location: ' . ADMINURL . '/products-admins/show-products.php');
          } else {
            echo "<script>alert('image upload failed');</script>";
          }
        }
      }

?>


    <div class="container mt-5" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px;">
       <div class="row">
        <div class="col">
        <h1 class="text-center mb-5">Create new products</h1>
          <div class="card rounded-4 shadow">
            <div class="card-body">
              <h3 class="card-title mb-5 d-inline">Create Products</h3>
              <form method="POST" action="create-products.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <label><h6>Product Name</h6></label>

                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label><h6>Product Price</label>

                    <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><h6>Product Description</h6></label>
                    <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label for="categorySelect"><h6>Select Category</h6></label>
                  <select name="category" id="categorySelect" class="form-control">
                    <option value="">--select category--</option> 
                    <?php foreach($allCategories as $category): ?>
                      <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="categorySelect"><h6>Select Category</h6></label>
                  <select name="category_id" id="categorySelect" class="form-control">
                    <option value="">--select category--</option> 
                    <?php foreach($allCategories as $category): ?>
                      <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label><h6>Product Image</h6></label>

                    <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label><h6>Product File</h6></label>
                    <input type="file" name="file" id="form2Example1" class="form-control" placeholder="file" />
                </div>

      
                
                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-dark text-light mb-4 btn-lg rounded-pill w-25" style="background-color: #020122;">create</button>
                </div>
          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>


<?php require "../includes/footer.php"; ?>