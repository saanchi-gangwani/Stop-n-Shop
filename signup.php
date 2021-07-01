<?php
require(__DIR__."/config/connection.php");
session_start();
//session redirection codes
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
