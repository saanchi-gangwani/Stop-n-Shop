<?php
require(__DIR__.'/config/connection.php');

session_start();
if(!isset($_SESSION['useremail'])){
  header('Location: login.php');
}

if(isset($_POST['address_submit'])){
  $type=0;
  if(isset($_POST['address_default']) && $_POST['address_default']=='yes'){
    $type = 1;
    $query = "select id, user_id from addresses where user_id=(select id from users where email='".$_SESSION['useremail']."') and type=1;";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)!=0){
      while($row = mysqli_fetch_assoc($result)){
        $queryUpdate = "update addresses set type=2 where user_id='".$row['user_id']."' and type=1;";
        if(!mysqli_query($con, $queryUpdate)){
          echo "Could not update default address as ".mysqli_error($con);
        }
      }
    }
  }
  else{
    $type=2;
  }

  if(isset($_POST['address_name']) && trim($_POST['address_name'])!="" && isset($_POST['address_building']) && trim($_POST['address_building'])!="" && isset($_POST['address_area']) && trim($_POST['address_area'])!="" && isset($_POST['address_city']) && trim($_POST['address_city'])!="" && isset($_POST['address_state']) && trim($_POST['address_state'])!="" && isset($_POST['address_country']) && trim($_POST['address_country'])!="" && isset($_POST['address_pincode']) && trim($_POST['address_pincode'])!="" && isset($_POST['address_phone']) && trim($_POST['address_phone'])!=""){
    $address=$_POST['address_name']."+".$_POST['address_building']."+".$_POST['address_area']."+".$_POST['address_city']."+".$_POST['address_state']."+".$_POST['address_country']."+".$_POST['address_pincode']."+".$_POST['address_phone'];
    $query = "insert into addresses(user_id, address, type) values((select id from users where email='".$_SESSION['useremail']."'),'".$address."','".$type."');";
    if(!mysqli_query($con, $query)){
      echo "Could not add address as ".mysqli_error($con);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/address.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/php/header.php'); ?>
      <div class="profilediv">
        <?php include(__DIR__.'/php/sidenav.php'); ?>
        <div class="addressdiv">
          <h3>Manage Addresses</h3>
          <?php
          $query = "select * from addresses where user_id = (select id from users where email = '".$_SESSION['useremail']."');";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result)!=0){
            ?>
            <div class="existingaddressdiv">
              <h4>Your Saved Addresses</h4>
              <!-- Add address grids -->
            </div>
            <?php
          }
          ?>
          <div class="newaddressdiv">
            <h4>Add New Address</h4>
            <form method="post">
              <div>
                <label for="address_name">Full Name:</label>
                <input type="text" name="address_name" id="address_name" placeholder="Full Name">
              </div>
              <div>
                <label for="address_building">House Number/ Building Name:</label>
                <input type="text" name="address_building" id="address_building" placeholder="House Number/ Building Name">
              </div>
              <div>
                <label for="address_area">Area/ Street Name:</label>
                <input type="text" name="address_area" id="address_area" placeholder="Area/ Street Name">
              </div>
              <div>
                <label for="address_city">District/ City:</label>
                <input type="text" name="address_city" id="address_city" placeholder="District/ City">
              </div>
              <div>
                <label for="address_state">State:</label>
                <input type="text" name="address_state" id="address_state" placeholder="State">
              </div>
              <div>
                <label for="address_country">Country:</label>
                <input type="text" name="address_country" id="address_country" placeholder="Country">
              </div>
              <div>
                <label for="address_pincode">Pincode:</label>
                <input type="text" name="address_pincode" id="address_pincode" placeholder="Pincode">
              </div>
              <div>
                <label for="address_phone">Phone Number:</label>
                <input type="number" name="address_phone" id="address_phone" placeholder="Phone Number">
              </div>
              <?php
              $query = "select id from addresses where user_id = (select id from users where email = '".$_SESSION['useremail']."');";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)==0){
                ?>
                <div>
                  <input type="checkbox" name="address_default" id="address_default" value="yes" disabled checked>
                  <input name="address_default" type="hidden" value="yes" id="address_default">
                  <label for="address_default">Set this address as your default address.</label>
                </div>
                <?php
                }
                else{
                ?>
                <div>
                  <input type="checkbox" name="address_default" id="address_default" value="yes">
                  <label for="address_default">Set this address as your default address.</label>
                </div>
                <?php
              }
              ?>
              <div>
                <button type="submit" name="address_submit" id="address_submit">ADD ADDRESS</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include(__DIR__.'/php/footer.php'); ?>
    </div>
  </body>
  <script type="text/javascript" src="js/master.js"></script>
</html>
