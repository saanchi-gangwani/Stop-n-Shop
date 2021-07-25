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
          <p>
            Welcome to Stop n Shop! SNS is a sample E-commerce website whose backend is completely built on Laravel PHP and MySQL Database. For the frontend, the website uses HTML, CSS, Vanilla JavaScript and some frontend frameworks like Bootstrap and jQuery.
          </p>
          <p>
            The site has all the major features of a real-world E-commerce website including registration and logging in of users, cart management, profile management, storage of multiple addresses etc.
          </p>
          <p>
            Refer the project's readme <a href="https://github.com/saanchi-gangwani/Stop-n-Shop/blob/main/README.md">here</a> to know more!!
          </p>
        </div>
        <div class="contactdiv">
          <h3>Contact Us</h3>
          <p>
            Visit the developers of this website on their GitHub:
            <ul>
              <li><a href='https://github.com/devoghub'>Devjyot Singh Sidhu</a></li>
              <li><a href='https://github.com/saanchi-gangwani/'>Saanchi Gangwani</a></li>
            </ul>
          </p>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
</html>
