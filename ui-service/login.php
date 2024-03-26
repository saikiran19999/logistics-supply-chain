<?php
include "db_connect.php";

session_start();

#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click() 

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = $_POST["password"];
	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["id"];
		$_SESSION["name"] = $row["first_name"];
		$ip_add = getenv("REMOTE_ADDR");
		//we have created a cookie in login_form.php page so if that cookie is available means user is not login
        
	//if user record is available in database then $count will be equal to 1
	if($count == 1){
		   	
			if($count == 1){
                $row = mysqli_fetch_array($run_query);
                $_SESSION["uid"] = $row["id"];
                $_SESSION["name"] = $row["first_name"];
                $ip_add = getenv("REMOTE_ADDR");
                //we have created a cookie in login_form.php page so if that cookie is available means user is not login


                    //if user is login from page we will send login_success
                    echo "login_success";

                    echo "<script> location.href='home.php'; </script>";
                    exit;

                }else{
                    echo "<span style='color:red;'>Please register before login..!</span>";
                    exit();
                }

		}
		else{
                    echo "<span style='color:red;'>Please register before login..!</span>";
                    exit();
                }
    
	
}

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
