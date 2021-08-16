<?php
require(__DIR__.'/config/connection.php');
session_start();
if(!isset($_SESSION['useremail'])){
  header('Location: login.php');
}

$orderId = $_GET['orderid'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Order Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/order_history.css">
    <link rel="icon" href="resources/icon.png">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="orderdiv">
        <?php include(__DIR__.'/php/sidenav.php'); ?>
        <div class="displaydiv">
          <h3>Order Details</h3>
          <?php
          $query = "select id from orders where user_id=(select id from users where email = '".$_SESSION['useremail']."') and id='".$orderId."';";
          $result = mysqli_query($con , $query);
          if(mysqli_num_rows($result)==0) echo "<script>window.location.replace('order_history.php')</script>";
          else{
            ?>
            <table class='table'>
              <thead class="thead-light">
                <tr>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <?php
              $query = "select * from order_products where order_id='".$orderId."';";
              $result = mysqli_query($con, $query);
              $totalPrice = $totalQuant = 0;
              while($row = mysqli_fetch_assoc($result)){
                $totalPrice += $row['price'];
                $totalQuant += $row['quantity'];
                ?>
                <tr>
                  <td>
                    <?php
                    $queryName = "select name from products where id='".$row['product_id']."'";
                    $resultName = mysqli_query($con , $queryName);
                    while($rowName = mysqli_fetch_assoc($resultName)) echo $rowName['name'];
                    ?>
                  </td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo '&#8377; '.$row['price']; ?></td>
                </tr>
                <?php
              }
              ?>
              <tfoot class='tfoot-light'>
                <tr>
                  <td>Total</td>
                  <td><?php echo $totalQuant; ?></td>
                  <td><?php echo '&#8377; '.number_format((float)$totalPrice, 2, '.', ''); ?></td>
                </tr>
              </tfoot>
            </table>
            <?php
          }
          ?>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
</html>
