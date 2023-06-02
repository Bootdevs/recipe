<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
  // Check if the "remember me" cookie exists
  if (isset($_COOKIE['remember_me'])) {
      // Unserialize the cookie value to get the email and password
      $values = unserialize($_COOKIE['remember_me']);
      // Set the email and password fields
      $email = $values[0];
      $password = $values[1];
  } else {
      // The cookie doesn't exist, so set the email and password fields to empty
      $email = '';
      $password = '';
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
    
</head>
<body>
    <div class="page">
        <div class="form ">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>        

            </div>  
            <form id= "login" action="./includes/login-inc.php" class="input active" method="post">
                <input type="text" class="input-field" placeholder="Email" name="email" value="<?php echo $email ?>">
                <div class="error"><?php if(isset($_GET['error']) && $_GET['error'] == 'emptyfields') echo 'Please fill in all fields.'; ?></div>
                <input type="password" class="input-field" placeholder="Enter password" name="password" value="<?php echo $password ?>">
                <div class="error"><?php if(isset($_GET['error']) && $_GET['error'] == 'emptyfields') echo 'Please fill in all fields.'; 
                        elseif(isset($_GET['error']) && $_GET['error'] == 'wrongpassword') echo 'Wrong password.'; 
                        elseif(isset($_GET['error']) && $_GET['error'] == 'nouser') echo 'No user found with this email.'; ?></div>
                <input type="checkbox"  class="check-box" name="remember"><span class="check">Remember password</span>
                <button type="submit" class="submit-btn" name="submit">Log in</button> 
                <a href="" class="forgot-password">Forgot password?</a>
            </form>
              <form id="register" action="./includes/register-inc.php" class="input" method="post">
                 <input type="text" class="input-field" placeholder="Email" name="email"> 
                 <input type="password" class="input-field" placeholder="Enter password" name="password" >
                  <input type="password" class="input-field" placeholder="Confirm password" name="confirmpassword"> 
                  <button type="submit" name="submit" class="submit-btn signup">Sign up</button> </form>
              
            </div>
           
    </div>

    <script >
var loginForm = document.getElementById("login");
var registerForm = document.getElementById("register");
var button = document.getElementById("btn");

function register() {
  loginForm.style.left = "-400px";
  registerForm.style.left = "50px";
  button.style.left = "110px";
}

function login() {
  loginForm.style.left = "50px";
  registerForm.style.left = "450px";
  button.style.left = "0px";
}

</script>
    
</body>
</html>