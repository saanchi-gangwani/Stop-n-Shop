<?php
require(__DIR__."/config/connection.php");

session_start();
if(isset($_SESSION['email'])){
  if($_SESSION['type']=='Customer'){
    header("Location:home.php");
  }
  else{
    header('Location:categories.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if(isset($_POST['reg_button'])){
      if(isset($_POST['reg_name']) && trim($_POST['reg_name'])!='' && isset($_POST['reg_email']) && trim($_POST['reg_email'])!='' && isset($_POST['reg_number']) && trim($_POST['reg_number'])!='' && isset($_POST['reg_password']) && trim($_POST['reg_password'])!=''){
        $query="insert into users(name,email,phone_no,password,type) values('".$_POST['reg_name']."','".$_POST['reg_email']."','".$_POST['reg_number']."','".$_POST['reg_password']."','Customer')";
        if(!mysqli_query($con,$query)){
          echo "Could not insert user data" .mysqli_error($con);
        }
      }
    }
    ?>
    <h2>SIGN UP FORM</h2>
    <form class="form registration-form" method="POST" action="">
      NAME <input type="text" name="reg_name" id="reg_name">
      <br>
      <br>
      EMAIL <input type="email" name="reg_email" id="reg_email">
      <br>
      <br>
      PHONE NO <input type="number" name="reg_number" id="reg_number">
      <br>
      <br>
      PASSWORD <input type="password" name="reg_password" id="reg_password">
      <br>
      <br>
      <button type="submit" name="reg_button">SIGN UP</button>
    </form>
    <hr>
    <h2>LOG IN FORM</h2>
    <?php
    if(isset($_POST['login_button'])){
      if(isset($_POST['login_password']) && trim($_POST['login_password'])!='' && isset($_POST['login_email']) && trim($_POST['login_email'])!=''){
          $query2="select password,type from users where email='".$_POST['login_email']."';";
          $result=mysqli_query($con,$query2);
          if(mysqli_num_rows($result)==0){
            echo "Incorrect email";
          }
          else{
            $password='';
            $type='';
            while($row=mysqli_fetch_assoc($result)){
            $password=$row['password'];
            $type=$row['type'];
            }
            if($password==$_POST['login_password']){
              $_SESSION['type'] = $type;
              $_SESSION['email'] = $_POST['login_email'];
              if($type=='Customer'){
                header('Location:home.php');
              }
              else if($type=='Admin'){
                header('Location:categories.php');
              }
            }
            else{
              echo "Incorrect Password";
            }
          }
      }
    }
    ?>
    <form class="form login-form" action="" method="POST">
      EMAIL ID <input type="email" name="login_email" id="login_email">
      <br>
      <br>
      PASSWORD <input type="password" name="login_password" id="login_password">
      <br>
      <br>
      <button type="submit" name="login_button">LOG IN</button>
    </form>
  </body>
  <script type="text/javascript">
  	if ( window.history.replaceState ) {
  		window.history.replaceState( null, null, window.location.href );
  	}
  </script>
</html>
