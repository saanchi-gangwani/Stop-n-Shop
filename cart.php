<?php
require(__DIR__."/config/connection.php");
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
    <title>Stop n Shop: Cart</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/cart.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/header.php'); ?>
      <div class="cartdiv">
        <div class="cartdisplaydiv">
          <?php
          $totalPrice=0;
          $cartId=0;
          $query="select * from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
          $result=mysqli_query($con,$query);
          if(mysqli_num_rows($result)==0){
            ?>
            <div class="nocartdiv">
              jaldi kar panvel nikalna hai
              <!-- display no cart comment -->
            </div>
            <?php
          }
          else{
            while($row=mysqli_fetch_assoc($result)){
              $totalPrice=$row['total_price'];
              $cartId=$row['id'];
            }
            $query="select * from cart_products where cart_id='".$cartId."';";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result))
            {
              // display cart products
              echo $row['product_id'];
              echo $row['price'];
            }
          }
          ?>
        </div>
        <div class="cartpricediv">

        </div>
      </div>
      <?php include(__DIR__.'/footer.php'); ?>
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
