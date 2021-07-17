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
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/about.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="contentdiv">
        <div class="aboutdiv">
          <h2>About Us</h2>
        </div>
        <div class="contactdiv">
          <h2>Contact Us</h2>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
</html>
