<?php
require(__DIR__."/config/connection.php");
session_start();
//session redirection codes
if(isset($_SESSION['useremail'])){
  header("Location:home.php");
}

if(isset($_POST['signup_submit'])){
  if(isset($_POST['signup_name']) && trim($_POST['signup_name'])!="" && isset($_POST['signup_email']) && trim($_POST['signup_email'])!="" && isset($_POST['signup_password']) && trim($_POST['signup_password'])!="" && isset($_POST['signup_confirm_password']) && trim($_POST['signup_confirm_password'])!="" && isset($_POST['signup_phone']) && trim($_POST['signup_phone'])!=""){
    if($_POST['signup_password']==$_POST['signup_confirm_password']){
      $pass = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
      $query = "insert into users(name, email, password, phone_no, type) values('".$_POST['signup_name']."','".$_POST['signup_email']."','".$pass."','".$_POST['signup_phone']."',2);";
      if(!mysqli_query($con, $query)){
        echo 'could not create user as '.mysqli_error($con);
      }
      else{
        $_SESSION['useremail'] = $_POST['signup_email'];
        header('Location: home.php');
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Sign Up</title>
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
            <legend>Sign Up</legend>
            <div class="">
              <form method="post">
                <div class="">
                  <input type="text" name="signup_name" id="signup_name" placeholder="Name">
                </div>
                <div class="">
                  <input type="email" name="signup_email" id="signup_email" placeholder="Email">
                </div>
                <div class="">
                  <input type="number" name="signup_phone" id="signup_phone" placeholder="Phone Number">
                </div>
                <div class="">
                  <input type="password" name="signup_password" id="signup_password" placeholder="Enter a Password">
                </div>
                <div class="">
                  <input type="password" name="signup_confirm_password" id="signup_confirm_password" placeholder="Re-enter the Password">
                </div>
                <div class="">
                  <button type="submit" name="signup_submit" id="signup_submit">SIGN UP</button>
                </div>
              </form>
            </div>
          </fieldset>
        </div>
        <div class="redirectdiv">
          Already a registered user, <a href='login.php'>Login Here</a>.
        </div>
      </div>
      </div>
    </div>
  </body>
</html>
