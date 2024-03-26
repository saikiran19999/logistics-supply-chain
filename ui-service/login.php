<?php 
include('db_connect.php');
session_start();

if(isset($_SESSION['login_id'])) {
    header("location:index.php?page=home");
    exit; // Stop execution to prevent further processing
}

// Check if the login form is submitted
if(isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize input to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Perform user authentication
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
        // Authentication successful
        $user = $result->fetch_assoc();
        $_SESSION['login_id'] = $user['id']; // Assuming 'id' is the primary key of the users table
        header("location:index.php?page=home");
        exit; // Stop execution to prevent further processing
    } else {
        // Authentication failed
        $error = "Invalid email or password.";
    }
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<body class="hold-transition login-page">
<div class="login-box" style="width: 30rem;hight: 30rem;">
  <div class="login-logo">
    <a href="#"><b><?php echo $_SESSION['system']['name'] ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card" style="width: 30rem;hight: 30rem;">
    <div class="card-body login-card-body">
      <form action="" method="post" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-10">
            <button type="submit" class="btn btn-primary">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include 'footer.php'; ?>

</body>
</html>
