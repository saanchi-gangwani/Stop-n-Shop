<?php
require(__DIR__."/../config/connection.php");
session_start();

$sign = substr($_POST['value'],-1);
$prodId = (int)substr($_POST['value'],0,-1);

$queryGet = "select * from cart inner join cart_products on cart.id=cart_products.cart_id where cart.user_id=(select id from users where email='".$_SESSION['useremail']."') and cart_products.product_id='".$prodId."';";
$resultGet = mysqli_query($con, $queryGet);

$quant = 0;
$cartId = 0;
$indivPrice = 0;
if(!mysqli_num_rows($resultGet)==0){
  while($rowGet = mysqli_fetch_assoc($resultGet)){
    $quant = $rowGet['quantity'];
    $cartId = $rowGet['cart_id'];
    $indivPrice = $rowGet['price']/$quant;
  }
}

if($sign=="-"){
  if($quant>=1){
    $query = "update cart set total_price=total_price-".$indivPrice." where id='".$cartId."' and user_id=(select id from users where email='".$_SESSION['useremail']."');";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }

    if($quant==1){
      $query = "delete from cart_products where cart_id='".$cartId."' and product_id='".$prodId."';";
      if(!mysqli_query($con, $query)){
        echo mysqli_error($con);
      }
      $query="select count(*) as num from cart_products where cart_id='".$cartId."';";
      $result=mysqli_query($con,$query);
      $num=0;
      while($row=mysqli_fetch_assoc($result)){
        $num=$row['num'];
      }
      if($num==0)
      {
        $query="delete from cart where id='".$cartId."';";
        if(!mysqli_query($con, $query)){
          echo mysqli_error($con);
        }
      }
    }
    else{
      $query = "update cart_products set quantity=quantity-1, price=price-".$indivPrice." where cart_id='".$cartId."' and product_id='".$prodId."';";
      if(!mysqli_query($con, $query)){
        echo mysqli_error($con);
      }
    }
  }
  if($quant!=0)
  $quant--;
}
else {
  $query="select * from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
  $result=mysqli_query($con,$query);
  if(mysqli_num_rows($result)==0)
  {
    $query="insert into cart(user_id,total_price) values((select id from users where email='".$_SESSION['useremail']."'),0);";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }
  }

  $query="select id from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result))
  {
    $cartId=$row['id'];
  }

  if($quant==0)
  {
    $query="insert into cart_products(cart_id,product_id,quantity,price) values('".$cartId."','".$prodId."',1,(select price from products where id='".$prodId."'));";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }
  }
  else{
    $query="update cart_products set quantity=quantity+1, price=price+".$indivPrice." where cart_id='".$cartId."' and product_id='".$prodId."';";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }
  }
  $query="update cart set total_price=total_price+(select price from products where id='".$prodId."');";
  if(!mysqli_query($con, $query)){
    echo mysqli_error($con);
  }
  $quant++;
}
echo $quant;
?>
