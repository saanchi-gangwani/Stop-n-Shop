<?php
require(__DIR__."/config/connection.php");
session_start();

if(!isset($_SESSION['useremail'])){
  header("Location:login.php");
}

//codes for click on plus and/or minus buttons go here
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/header.php'); ?>
      <div class="carouseldiv">
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="resources/carousel_1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="resources/carousel_2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="resources/carousel_3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="productdiv">
        <?php
        $queryCat = "select name from categories;";
        $resultCat = mysqli_query($con, $queryCat);
        while($rowCat = mysqli_fetch_assoc($resultCat)){
          ?>
          <div class="categorydiv">
            <h3><?php echo $rowCat['name']; ?></h3>
            <div class="productdisplaydiv">
            <?php
            $queryProd = "select * from products where category_id=(select id from categories where name='".$rowCat['name']."');";
            $resultProd = mysqli_query($con,$queryProd);
            while($rowProd = mysqli_fetch_assoc($resultProd)){
              ?>
              <div class="productinfodiv">
                <div class="productimagediv" style="background-image: url('<?php echo $rowProd['image']; ?>');">
                </div>
                <div class="productnamediv">
                  <?php echo $rowProd['name']; ?>
                </div>
                <div class="productmathsdiv">
                  <div class="productpricediv">
                    &#8377; <?php echo $rowProd['price']; ?>
                  </div>
                  <div class="productquantdiv">
                    <form method="post">
                      <div class="quantdiv">
                        <button type="submit" name="minusbutton" value="<?php echo $rowProd['id']; ?>">-</button>
                        <span class="cartvlauespan" id="cartvalue_<?php echo $rowProd['id']; ?>">
                          <?php
                          $queryCart = "select * from cart inner join cart_products on cart.id=cart_products.cart_id where cart.user_id=(select id from users where email='".$_SESSION['useremail']."') and cart_products.product_id='".$rowProd['id']."';";
                          $resultCart = mysqli_query($con, $queryCart);
                          if(mysqli_num_rows($resultCart)==0) echo "0";
                          else{
                            while($rowCart = mysqli_fetch_assoc($resultCart)){
                              echo $rowCart['quantity'];
                            }
                          }
                          ?>
                        </span>
                        <button type="submit" name="plusbutton" value="<?php echo $rowProd['id']; ?>">+</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/master.js"></script>
</html>
