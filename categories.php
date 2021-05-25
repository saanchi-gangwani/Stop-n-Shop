<?php
require(__DIR__.'/config/connection.php');

session_start();
function errorMsg($msg){
 echo "<div id='errordiv'>
        <p>".$msg."</p>
        <button type='button' onclick='closeError();'>Ok</button>
       </div>";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="bodydiv">
      <?php include(__DIR__.'/background.php'); ?>
      <div class="contentdiv">
        <div class="tablediv">
          <h2>Edit Categories</h2>
          <?php
            if(isset($_POST['category_delete'])){
              $id=$_POST['category_delete'];
              $query="delete from categories where id='".$id."';";
              if(!mysqli_query($con,$query)){
                errorMsg("Could not delete the category as ".mysqli_error($con));
              }
            }
          ?>
          <form action="" method="post">
            <table>
              <tr>
                <th>Name</th>
                <th>Delete</th>
                <th>Modify</th>
              </tr>
              <?php
                $query="select * from categories;";
                $result=mysqli_query($con,$query);
                while ($row=mysqli_fetch_assoc($result)){
                ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><button value="<?php echo $row['id']; ?>" type="submit" name="<?php echo 'category_delete';?>" id="<?php echo 'category_delete';?>">X</button></td>
                <td></td>
              </tr>
              <?php
                }
              ?>
            </table>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script src="js/admin.js"></script>
  <script type="text/javascript">
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>
</html>
