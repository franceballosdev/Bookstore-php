 <?php require '../includes/header.php'; ?>
 <?php require '../config/config.php'; ?>

<?php

    if(isset($_SESSION['username'])) {
        echo '<script> alert("You are already logged in") </script>';
        header('location: '.APPURL. "");
        
    }
    if(isset($_POST['submit'])) {
       if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])) {
           echo '<script> alert("All fields are required") </script>';
       } else {
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];

           // Check if user or email exist in the database
           $checkUser = $conn->prepare("SELECT id FROM users WHERE username = :username");
           $checkUser->execute(['username' => $username]);
           $userExists = $checkUser->fetch(PDO::FETCH_ASSOC);

           $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = :email");
           $checkEmail->execute(['email' => $email]);
           $emailExists = $checkEmail->fetch(PDO::FETCH_ASSOC);

           if($userExists || $emailExists) {
               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Oops!</strong> User or email already exists.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
           } else {
               $insert = $conn->prepare ("INSERT INTO users (username, email, mypassword) VALUES (:username, :email, :mypassword)");

               $insert->execute([
                   'username' => $username,
                   'email' => $email,
                   'mypassword' => password_hash($password, PASSWORD_DEFAULT),
               ]);

               header('location:login.php');
           }
       }
    }
?>

<div class="container" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px; margin-top: 100px;">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow p-3 mb-5 bg-white rounded-4 mt-5">
        <form id="register-form" action="register.php" method="POST" class="mt-3">
          <h4 class="text-center mt-3">Register</h4>
          <div class="form-group mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required <?php if(isset($_POST['submit'])) { echo 'oninput="checkUsername(this)"'; } ?>>
            <div class="invalid-feedback">Username already exists.</div>
          </div>
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
            pattern="[^@\s]+@[^@\s]+[\.][^@\s]+" 
            title="Enter a valid email address" 
            required 
            oninvalid="this.setCustomValidity('Please enter a valid email')" 
            oninput="this.setCustomValidity(''); checkEmail(this)">
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6" oninput="checkPassword(this)">
            <div class="invalid-feedback">Password must be at least 6 characters and contain letters and numbers.</div>
          </div>
          <div class="form-group mb-3">
            <label for="repeat-password" class="form-label">Repeat Password</label>
            <input type="password" class="form-control" id="repeat-password" name="repeat-password" required oninput="checkPasswords(this, 'password')">
          </div>
          <div class="form-group mb-3">
            <button type="send" id="submit" name="submit" class="btn btn-dark btn-lg  w-100 rounded-pill mt-5" style="background-color: #0D0630;">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    function checkPasswords(input, otherId) {
      var otherInput = document.getElementById(otherId);
      if (input.value !== otherInput.value) {
        input.setCustomValidity('Passwords do not match.');
      } else {
        input.setCustomValidity('');
      }
    }
    function checkPassword(input) {
      if (!/^(?=.*\d)(?=.*[a-z])[\w!@#$%^&*()-]{6,}$/.test(input.value)) {
        input.setCustomValidity('Password must be at least 6 characters and contain letters and numbers.');
      } else {
        input.setCustomValidity('');
      }
    }
</script>
</script>
<?php require '../includes/footer.php'; ?>