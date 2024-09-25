<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 

<?php
    if(!isset($_SESSION['admin_name'])) {
      header('location: '.ADMINURL. "/admins/login-admins.php");     
  }

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $conn->query("SELECT * FROM categories WHERE id='$id'");
    $select->execute();

    $categories = $select->fetch(PDO::FETCH_OBJ);


    if(isset($_POST['submit'])) {
      if(empty($_POST['name']) OR empty($_POST['description'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
      } else {
        
        unlink("../../images/".$images->image."");
  
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
  
        $dir = "../../images/" . basename($image);
  
        $update = $conn->prepare("UPDATE categories SET name=:name, description=:description, image=:image WHERE id='$id'");
        $update->execute([
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


  }else {
    header("Location: categories.php");
  }



?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title mb-5 d-inline">Update Categories</h3>
                        <form method="POST" action="update-category.php?id=<?php echo $id ?>" enctype="multipart/form-data">
                            <div class="form-group mt-4">
                                <label for="name"><h6>Name</h6></label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($categories->name, ENT_QUOTES); ?>"
                                       id="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group mt-4">
                                <label for="description"><h6>Description</h6></label>
                                <textarea name="description" id="description" class="form-control"
                                          placeholder="Description" rows="10" required><?php echo htmlspecialchars($categories->description, ENT_QUOTES); ?></textarea>
                            </div>
                            <div class="mt-4">
                                <img src="../../images/<?php echo htmlspecialchars($categories->image, ENT_QUOTES); ?>" alt="Current image" width="400">
                            </div>
                            <div class="form-group mt-4">
                                <label for="image"><h6>Image</h6></label>
                                <input type="file" name="image" id="image" class="form-control" placeholder="Image" required>
                            </div>

                            <div class="mt-4">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer.php"; ?>