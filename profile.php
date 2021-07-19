<?php
require(__DIR__.'/config/connection.php');
session_start();
if(!isset($_SESSION['useremail'])){
  header('Location: login.php');
}


$query="select * from users where email='".$_SESSION['useremail']."';";
$result=mysqli_query($con,$query);
$name=$phone=$password=$email="";
while($row=mysqli_fetch_assoc($result))
{
  $name=$row['name'];
  $phone=$row['phone_no'];
  $password=$row['password'];
  $email=$row['email'];
}

if(isset($_POST['update_submit'])){
  if(isset($_POST['update_name']) && trim($_POST['update_name'])!=""){
    $query="update users set name='".$_POST['update_name']."' where email='".$_SESSION['useremail']."';";
    if(!mysqli_query($con,$query)){
      echo "could not update profile as ".mysqli_error($con);
    }
    else{
      header("Location:profile.php");
    }
  }
  if(isset($_POST['update_password']) && trim($_POST['update_password'])!="" && $_POST['update_password']==$_POST['update_confirm_password']){
    $query="update users set password='".$_POST['update_password']."' where email='".$_SESSION['useremail']."';";
    if(!mysqli_query($con,$query)){
      echo "could not update profile as ".mysqli_error($con);
    }
    else{
      header("Location:profile.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop: Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/profile.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="profilediv">
        <?php include(__DIR__.'/php/sidenav.php'); ?>
        <div class="accountdiv">
          <h3>Profile Settings</h3>
          <form method="post">
            <div class="">
              <label for="update_name">Name:</label>
              <input type="text" name="update_name" id="update_name" placeholder="Name" value="<?php echo $name; ?>">
            </div>
            <div class="">
              <label for="update_email">Email:</label>
              <input type="email" name="update_email" id="update_email" placeholder="Email" disabled="true" value="<?php echo $email; ?>">
            </div>
            <div class="">
              <label for="update_phone">Phone Number:</label>
              <input type="number" name="update_phone" id="update_phone" placeholder="Phone Number" disabled="true" value="<?php echo $phone; ?>">
            </div>
            <div class="">
              <label for="update_password">Set a new password:</label>
              <input type="password" name="update_password" id="update_password" placeholder="Enter a Password">
            </div>
            <div class="">
              <label for="update_confirm_password">Confirm new password:</label>
              <input type="password" name="update_confirm_password" id="update_confirm_password" placeholder="Re-enter the Password">
            </div>
            <div class="">
              <button type="submit" name="update_submit" id="update_submit">UPDATE</button>
            </div>
          </form>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
