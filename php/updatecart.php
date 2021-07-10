<!-- handle cases when cart exsits or to be created -->
<?php
require(__DIR__."/../config/connection.php");
session_start();

$sign = substr($_POST['value'],-1);
$prodId = (int)substr($_POST['value'],0,-1);
// echo $id;
$queryGet = "select * from cart inner join cart_products on cart.id=cart_products.cart_id where cart.user_id=(select id from users where email='".$_SESSION['useremail']."') and cart_products.product_id='".$prodId."';";
$resultGet = mysqli_query($con, $queryGet);

//cases: n+, n-, 1-, 0+
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

  if($quant==1){
    $query = "update cart set total_price=total_price-".$indivPrice." where id='".$cartId."' and user_id=(select id from users where email='".$_SESSION['useremail']."');";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }
    $query = "delete from cart_products where cart_id='".$cartId."' and product_id='".$prodId."';";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }

  } else if($quant>1){
    $query = "update cart set total_price=total_price-".$indivPrice." where id='".$cartId."' and user_id=(select id from users where email='".$_SESSION['useremail']."');";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }
    $query = "update cart_products set quantity=quantity-1, price=price-".$indivPrice." where cart_id='".$cartId."' and product_id='".$prodId."';";
    if(!mysqli_query($con, $query)){
      echo mysqli_error($con);
    }

  }
} else{
  if($quant == 0){
    $query = "select price from products where id='".$prodId."';";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){
      $indivPrice = $row['price'];
    }


  } else{

  }
}

?>
