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
    <script type="text/javascript" src="js/master.js"></script>
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="cartdiv">
        <div class="cartdisplaydiv" id='cartdisplaydiv'>
          <?php
          $totalPrice=0;
          $cartId=0;
          $query="select * from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
          $result=mysqli_query($con,$query);
          if(mysqli_num_rows($result)==0){
            ?>
            <script type="text/javascript">
            document.write(createNoCartDiv());
            </script>
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
              <div class="cartproductdiv" id="cartproductdiv_<?php echo $row['product_id']; ?>">
                <?php
                $queryProd="select image from products where id='".$row['product_id']."';";
                $resultProd=mysqli_query($con,$queryProd);
                while($rowProd=mysqli_fetch_assoc($resultProd))
                {
                 ?>
                 <div class="productimagediv" style="background-image: url('<?php echo $rowProd['image']; ?>');">
                 </div>
                 <?php
                }
                ?>
                <div class="productinfodiv">
                  <div class="productnamediv">
                    <?php
                    $queryProd = "select name from products where id='".$row['product_id']."';";
                    $resultProd = mysqli_query($con, $queryProd);
                    while($rowProd = mysqli_fetch_assoc($resultProd)){
                      echo $rowProd['name'];
                    }
                    ?>
                  </div>
                  <div class="productmathsdiv">
                    <div class="productpricediv">
                      <span id='pricevalue_<?php echo $row['product_id']; ?>' class="pricevaluespan">
                        &#8377; <?php echo $row['price']; ?>
                      </span>
                    </div>
                    <div class="productquantdiv">
                      <button type="button" name="minus2button" id="minus2button" value="<?php echo $row['product_id']."-"; ?>" onclick="update2Cart(this.value)">-</button>
                      <span class="cartvlauespan" id="cartvalue_<?php echo $row['product_id']; ?>">
                        <?php
                        $queryCart = "select * from cart inner join cart_products on cart.id=cart_products.cart_id where cart.user_id=(select id from users where email='".$_SESSION['useremail']."') and cart_products.product_id='".$row['product_id']."';";
                        $resultCart = mysqli_query($con, $queryCart);
                        if(mysqli_num_rows($resultCart)==0) echo "0";
                        else{
                          while($rowCart = mysqli_fetch_assoc($resultCart)){
                            echo $rowCart['quantity'];
                          }
                        }
                        ?>
                      </span>
                      <button type="button" name="plus2button" id="plus2button" value="<?php echo $row['product_id']."+"; ?>" onclick="update2Cart(this.value)">+</button>
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
          <hr>
          <div class="cartinfodiv">
            <div>
              Total Price
            </div>
            <div class="carttotaldiv" id="carttotaldiv">
              <?php
              $query="select total_price from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
              $result=mysqli_query($con,$query);
              while($row=mysqli_fetch_assoc($result))
              {
                echo "&#8377; ".$row['total_price'];
              }
              ?>
            </div>
            <div>
              Total Quantity
            </div>
            <div class="cartquantdiv" id="cartquantdiv">
              <?php
              $query="select sum(quantity) as q from cart_products inner join cart on cart.id=cart_products.cart_id where cart.user_id=(select id from users where email='".$_SESSION['useremail']."');";
              $result=mysqli_query($con,$query);
              while($row=mysqli_fetch_assoc($result))
              {
                echo $row['q'];
              }
              ?>
            </div>
          </div>
          <hr>
          <div class="checkoutdiv">
            <button type="button" name="button">Checkout</button>
          </div>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</html>
