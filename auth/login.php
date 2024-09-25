<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>

<?php

    if(isset($_SESSION['username'])) {
        echo '<script> alert("You are already logged in") </script>';
        header('location: '.APPURL. "");
        
    }
    if(isset($_POST['submit'])) {
       if(empty($_POST['email']) OR empty($_POST['password'])) {
           echo '<script> alert("All fields are required") </script>';
       } else {
           $email = $_POST['email'];
           $password = $_POST['password'];

           $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
           $login->execute();

           $fetch = $login->fetch(PDO::FETCH_ASSOC);

           if($login->rowCount() > 0) {
               if(password_verify($password, $fetch['mypassword'])) {
                   $_SESSION['username'] = $fetch['username'];
                   $_SESSION['user_id'] = $fetch['id'];
                   $_SESSION['email'] = $fetch['email'];
                   header('location: '.APPURL. "");
               } else {
                   echo '<script> alert("Incorrect password") </script>';
               }
           }else {
               echo '<script> alert("User does not exist") </script>';
           }
       }
    }

?>
<div class="container " style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px; margin-top: 100px;">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card rounded-4 shadow mt-5 mb-5">
        <div class="card-body">
          <form class="mt-4" method="POST" action="login.php">
            <h2 class="text-center mb-4">Login</h2>
            <div class="form-group mt-4 mb-4">
              <label for="inputEmail" class="form-label"><h6>Email</h6></label>
              <input type="email" name="email" class="form-control" placeholder=" Please insert your email" id="inputEmail" required>
            </div>
            <div class="form-group mt-4 mb-4">
              <label for="inputPassword" class="form-label"><h6>Password</h6></label>
              <input type="password" name="password" class="form-control" placeholder="Please insert your password" id="inputPassword" required>
            </div>
            <div class="text-center mt-4 mb-2">
              <button class="btn btn-dark rounded-pill w-100 btn-lg" style="background-color: #0D0630; margin-bottom: 5px; margin-top: 5px" name="submit" type="submit">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require '../includes/footer.php'; ?>