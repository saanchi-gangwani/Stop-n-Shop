<?php
require(__DIR__."/config/connection.php");
session_start();
// session redirection codes
if(isset($_SESSION['useremail'])){
  header("Location:home.php");
}

if(isset($_POST['login_submit'])){
  if(isset($_POST['login_email']) && trim($_POST['login_email'])!="" && isset($_POST['login_password']) && trim($_POST['login_password'])!=""){
    $query = "select password from users where email='".$_POST['login_email']."';";
    $result = mysqli_query($con, $query);

    $pass = false;
    while($row = mysqli_fetch_assoc($result)){
      $pass = password_verify($_POST['login_password'], $row['password']);
    }

    if($pass){
      $_SESSION['useremail'] = $_POST['login_email'];
      header("Location:home.php");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Login</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/enter.css">
  </head>
  <body>
    <div class="bodydiv">
      <div class="logodiv">
        <img src="resources/logo.png" alt="Stop n Shop">
      </div>
      <div class="formdiv">
        <div class="">
        </div>
        <div class="fielddiv">
          <fieldset>
            <legend>Login</legend>
            <div class="">
              <form method="post">
                <div class="">
                  <input type="email" name="login_email" id="login_email" placeholder="Email">
                </div>
                <div class="">
                  <input type="password" name="login_password" id="login_password" placeholder="Password">
                </div>
                <div class="">
                  <button type="submit" name="login_submit" id="login_submit">LOGIN</button>
                </div>
              </form>
            </div>
          </fieldset>
        </div>
        <div class="redirectdiv">
          If you are a new user, <a href='signup.php'>Sign Up Here</a>.
        </div>
      </div>
    </div>
  </body>
  <script src="js/master.js"></script>
</html>
