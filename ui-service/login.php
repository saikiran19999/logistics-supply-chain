<?php
// Database connection parameters
$hostname = "15.223.57.95:82"; // or your database host
$port = '82';
$username = "sai";
$password = "sai";
$database = "cms_db";

// Create a new database connection
$conn = new mysqli($hostname, $username, $password, $database, $port);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT * FROM users";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    // Process the results
    while ($row = $result->fetch_assoc()) {
        // Process each row
        echo "Column1: " . $row["column1"] . ", Column2: " . $row["column2"] . "<br>";
    }
}

// Close the database connection
$conn->close();
?>
<?php 
include('db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM users")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

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
      <form action="" id="login-form">
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
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
