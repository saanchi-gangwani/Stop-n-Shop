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
              <span>Your cart is empty :( </span>
              <span>You may go to Stop n Shop home page to explore more products ;)</span>
              <a href="home.php"><button type="button" name="button">Home page</button></a>
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
              ?>
              <div class="cartproductdiv">
                <?php
                $queryProd="select image from products where id='".$row['product_id']."';";
                $resultProd=mysqli_query($con,$queryProd);
                while($rowProd=mysqli_fetch_assoc($resultProd))
                {
                 ?>
                 <div class="productimagediv" style="background-image: url('<?php echo $rowProd['image']; ?>');">
                 </div>
                 <!-- Work done till here -->
                 <?php
                }
                ?>
                <div class="productinfodiv">
                  <div class="productnamediv">

                  </div>
                  <div class="productmathsdiv">
                    <div class="productpricediv">

                    </div>
                    <div class="productquantdiv">

                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
        <div class="cartpricediv">
          <!-- Total price  -->
        </div>
      </div>
      <?php include(__DIR__.'/footer.php'); ?>
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
