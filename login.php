<?php
require(__DIR__."/config/connection.php");
session_start();
//session redirection codes
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
              <form class="" action="" method="post">
                <div class="">
                  <label for="login_email">Email</label>
                </div>
                <div class="">
                  <input type="email" name="login_email" id="login_email" placeholder="Email">
                </div>
                <div class="">
                  <label for="login_password">Password</label>
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
        <div class="">
        </div>
      </div>
    </div>
  </body>
  <script src="js/master.js"></script>
</html>
