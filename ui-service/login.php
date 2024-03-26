<?php 
session_start();
include('db_connect.php');

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Perform the login validation here (replace this with your actual validation logic)
    // For demonstration purposes, let's assume the username is "admin" and the password is "admin123"
    if ($email == 'admin' && $password == 'admin123') {
        // Set session variables to indicate that the user is logged in
        $_SESSION['login_id'] = 1; // Assuming 1 as the login ID
        
        // Redirect the user to the home page
        header("location: index.php?page=home");
        exit(); // Stop further execution
    } else {
        // Invalid username or password
        echo '<div class="alert alert-danger">Username or password is incorrect.</div>';
    }
}
?>

<?php include 'header.php' ?>
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
      <form action="" id="login-form" method="post"> <!-- Add method="post" -->
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
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          location.href ='index.php?page=home';
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
