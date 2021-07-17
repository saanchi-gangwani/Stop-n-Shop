<?php
if(!isset($_POST['check'])){
  header("Location: ../errors/404notfound.php");
  exit;
}

require(__DIR__."/../config/connection.php");
session_start();

$query="select total_price,id from cart where user_id=(select id from users where email='".$_SESSION['useremail']."');";
$result=mysqli_query($con,$query);

$data="";
$cartId=0;
if(mysqli_num_rows($result)==0){
  $data.="0-";
}
while($row=mysqli_fetch_assoc($result))
{
  $data.=$row['total_price'].'-';
  $cartId=$row['id'];
}

$query="select sum(quantity) as q from cart_products where cart_id='".$cartId."';";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==0){
  $data.="0";
}
while($row=mysqli_fetch_assoc($result))
{
  $data.=$row['q'];
}
 echo $data;
 ?>
