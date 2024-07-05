<?php
include "database.php";
include "functions.php";

if($userLog==1)
{
  header("Location: students.php");
  exit();
}

headtag("Login");

echo '<div class="logo">
        <img src="tailwebs.png" alt="Tailwebs" style="max-width: 10%;">
      </div>

      <div class="form-container">';

if(isset($_POST["username"])) {
  
  $username = strtolower(formpost($db, "username"));
  $password = formpost($db, "password");
  $md5Pass = md5($password);

  // Check if User Exists
  $query = "SELECT id FROM teachers WHERE username='$username' AND password='$md5Pass'";
  $userRows = mysqli_num_rows(mysqli_query($db, $query));

  // Check For Errors
  $errors = array();

  if(strlen($username) < 1 || strlen($password) < 1) {
    $errors[] = 'Please fill all the fields';
  } else if($userRows < 1) {
    $errors[] = 'Wrong Credentials';
  }

  if(empty($errors)) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $md5Pass;

    // Redirect to students.php upon successful login
    header("Location: students.php");
    exit();
  } else {
    foreach($errors as $error) {
      echo '<div class="alert alert-danger text-center"><strong><i class="fa fa-close"></i> '.$error.'</strong>.</div>';
    }
  }
}
?>

<form method="post">
  <div class="form-group">
    <label for="username">Username </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
    </div>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
      </div>
      <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
      <div class="input-group-append">
        <span class="input-group-text">
          <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
        </span>
      </div>
    </div>
  </div>

  <a href="#" class="float-right">Forgot Password?</a>
  <br><br><br>
  <button type="submit" class="btn btn-dark btn-block">Login</button>
</form>
</div>

<script>
  function togglePassword() {
    var passwordField = document.getElementById('password');
    var icon = document.querySelector('.toggle-password');
        
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordField.type = "password";
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>

</body>
</html>