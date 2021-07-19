<?php
require(__DIR__.'/config/connection.php');
session_start();
if(!isset($_SESSION['useremail'])){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/profile.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="profilediv">
        <?php include(__DIR__.'/php/sidenav.php'); ?>
        <div class="accountdiv">
          <h3>Profile Settings</h3>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
</html>
