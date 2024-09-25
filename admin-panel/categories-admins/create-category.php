<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 
<?php 


    if(!isset($_SESSION['admin_name'])) {
      header("location: ".ADMINURL."/admins/login-admins.php");
    }


  if(isset($_POST['submit'])) {
    if(empty($_POST['name']) OR empty($_POST['description'])) {
      echo "<script>alert('one or more inputs are empty');</script>";
    } else {

      $name = $_POST['name'];
      $description = $_POST['description'];
      $image = $_FILES['image']['name'];

      $dir = "../../images/" . basename($image);

      $insert = $conn->prepare("INSERT INTO categories (name, description, image) VALUES 
      (:name, :description, :image)");
      $insert->execute([
        ":name" => $name,
        ":description" => $description,
        ":image" => $image,
      ]);

      if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
        header("location: ".ADMINURL."/categories-admins/show-categories.php");
      } else {
        echo "<script>alert('image upload failed');</script>";
      }
    }
  }

?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <div class="card rounded-4 shadow">
        <div class="card-body">
          <h2 class="card-title mb-5">Create Category</h2>
          <form method="POST" action="create-category.php" enctype="multipart/form-data" class="mt-4">
            <div class="form-group mb-4">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group mb-4">
              <label for="description">Description</label>
              <textarea name="description" id="description" class="form-control" placeholder="Description" rows="10" required></textarea>
            </div>
            <div class="form-group mb-4">
              <label for="image">Image</label>
              <input type="file" name="image" id="image" class="form-control" placeholder="Image" required>
            </div>
            <button type="submit" name="submit" class="btn btn-dark btn-lg d-block mx-auto w-50 rounded-pill" style="background-color: #020122;">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "../includes/footer.php"; ?>  
