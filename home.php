<?php
require(__DIR__."/config/connection.php");
session_start();

if(!isset($_SESSION['useremail'])){
  header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <div class="bodydiv">
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
