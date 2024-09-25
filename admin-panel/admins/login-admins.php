<?php include '../includes/header.php'; ?>
<?php include '../../config/config.php'; ?>


<?php

    if(isset($_SESSION['admin_name'])) {
        header('location: '.ADMINURL. "");
    }

    if(isset($_POST['submit'])) {
       if(empty($_POST['email']) OR empty($_POST['password'])) {
           echo '<script> alert("All fields are required") </script>';
       } else {

           $email = $_POST['email'];
           $password = $_POST['password'];

           $login = $conn->query("SELECT * FROM admins WHERE email='$email'");
           $login->execute();

           $fetch = $login->fetch(PDO::FETCH_ASSOC);

           if($login->rowCount() > 0) {
               if(password_verify($password, $fetch['mypassword'])) {
                   $_SESSION['admin_name'] = $fetch['admin_name'];
                   $_SESSION['admin_id'] = $fetch['id'];

                   header('location: '.ADMINURL. "");
               } else {
                   ?>
                   <div class="alert alert-danger" role="alert">
                     Incorrect password
                   </div>
                   <?php
                  
               }
           }else {
               ?>
               <div class="alert alert-danger" role="alert">
                 User does not exist
               </div>
               <?php
           }
       }
    }

?>


<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-2">
      <div class="card rounded-4 shadow">
        <div class="card-body">
          <h2 class=" mt-5 text-center mb-4">Login</h2>
          <form method="POST" action="login-admins.php" class="p-4">
            <div class="form-outline mb-4">
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                placeholder="Email" 
                required
              >
            </div>
            <div class="form-outline mb-4">
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                placeholder="Password" 
                required
              >
            </div>
            <button 
              type="submit" 
              name="submit" 
              class="btn btn-dark text-white w-100 mb-4 mt-4 rounded-pill btn-lg"
              style="background-color: #020122;"
            >
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>


<?php include '../includes/footer.php'; ?>