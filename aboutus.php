<?php
session_start();

if(!isset($_SESSION['useremail']))
{
  header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: About</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/about.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="contentdiv">
        <div class="aboutdiv">
          <h3>About Us</h3>
        </div>
        <div class="contactdiv">
          <h3>Contact Us</h3>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
</html>
