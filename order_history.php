<?php
require(__DIR__.'/config/connection.php');
session_start();
if(!isset($_SESSION['useremail'])){
  header('Location: login.php');
}

if(isset($_GET['detailsbutton'])){
  header('Location: order_details.php?orderid='.$_GET['detailsbutton']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Order History</title>
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
          <h3>Your Order History</h3>
          <?php
          $query="select * from orders where user_id=(select id from users where email='".$_SESSION['useremail']."');";
          $result=mysqli_query($con,$query);
          if(mysqli_num_rows($result)==0)
          {
            ?>
            <span>
              You don't have any orders...
            </span>
            <?php
          }
          else {
            ?>
            <div>
              <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th>Order ID</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date (YYYY-MM-DD)</th>
                    <th>Order Details</th>
                  </tr>
                </thead>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {
                  $query2="select sum(quantity) as total from order_products where order_id='".$row['id']."';";
                  $result2=mysqli_query($con,$query2);
                  $total_quantity=0;
                  while($row2=mysqli_fetch_assoc($result2))
                  {
                    $total_quantity=$row2['total'];
                  }
                  ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $total_quantity; ?></td>
                    <td><?php echo "&#8377; ".$row['price']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><form method="get"><button type='submit' value='<?php echo $row['id']; ?>' name='detailsbutton' id='detailsbutton'>View Details</button></td>
                  </tr>
                  <?php
                }
                ?>
              </table>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
