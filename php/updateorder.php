<?php
if(!isset($_POST['check'])){
  header("Location: ../errors/404notfound.php");
  exit;
}

require(__DIR__."/../config/connection.php");
session_start();

$query = "select * from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
$result = mysqli_query($con, $query);
$totalPrice=0;
$cartId=0;
while($row = mysqli_fetch_assoc($result)){
  $totalPrice = $row['total_price'];
  $cartId = $row['id'];
}

$query = "select id from addresses where user_id=(select id from users where email='".$_SESSION['useremail']."') and type=1;";
$result = mysqli_query($con, $query);
$addressId = 0;
while($row = mysqli_fetch_assoc($result)){
  $addressId = $row['id'];
}

$query = "insert into orders(user_id, order_date, price, address_id) values((select id from users where email='".$_SESSION['useremail']."'), (select curdate()), '".$totalPrice."', '".$addressId."');";
if(!mysqli_query($con, $query)){
  echo mysqli_error($con);
}

$orderId = mysqli_insert_id($con);

$query = "select * from cart_products where cart_id='".$cartId."';";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result)){
  $price = $row['price'];
  $productId = $row['product_id'];
  $quant = $row['quantity'];

  $addQuery = "insert into order_products(order_id, product_id, quantity, price) values('".$orderId."', '".$productId."', '".$quant."', '".$price."');";
  if(!mysqli_query($con, $addQuery)){
    echo mysqli_error($con);
  }
}

$query = "delete from cart_products where cart_id='".$cartId."';";
if(!mysqli_query($con, $query)){
  echo mysqli_error($con);
}

$query = " delete from cart where id = '".$cartId."';";
if(!mysqli_query($con, $query)){
  echo mysqli_error($con);
}

echo 1;
?>
