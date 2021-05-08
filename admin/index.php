<?php
require(__DIR__."/../config/connection.php");

if(isset($_POST['update'])){
	if(isset($_POST['name']) && trim($_POST['name'])!=""){
		$query="insert into categories(name) values('".$_POST["name"]."');";
		if(!mysqli_query($con,$query)){
			echo 'Could not add category name '.mysqli_error($con).'<br>';
		}
	}

	if(isset($_POST['modifyid']) && trim($_POST['modifyid'])!=""){
		if(ctype_digit($_POST['modifyid'])){
			if(isset($_POST['setto']) && trim($_POST['setto'])!=""){
				$query="update categories set name='".$_POST["setto"]."' where id='".$_POST["modifyid"]."';";
				if(!mysqli_query($con,$query)){
					echo 'Could not update the value as '.mysqli_error($con).'<br>';
				}
			}
		}
		else{
			echo "'Modify ID' needs to be a valid row index<br>";
		}
	}

	if(isset($_POST['toremove']) && trim($_POST['toremove'])!=""){
		if(ctype_digit($_POST['toremove'])){
			$query="delete from categories where id='".$_POST["toremove"]."';";
			if(!mysqli_query($con,$query)){
				echo 'could not delete the row as '.mysqli_error($con).'<br>';
			}
		}
		else{
			echo "'Delete Row ID' needs to be a valid row index<br>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="form category-form">
		<h2>
			CATEGORY
		</h2>
		<form action="" method="post">
			ADD CATEGORY NAME
			<input type="text" name="name" id="name">
			<br>
			<br>
			MODIFY ID
			<input type="text" name="modifyid" id="modifyid">
			<br>
			<br>
			SET TO
			<input type="text" name="setto" id="setto">
			<br>
			<br>
			DELETE ROW ID
			<input type="text" name="toremove" id="toremove">
			<br>
			<br>
			<button type="submit" name='update' id='update'> UPDATE CATEGORY TABLE</button>
		</form>
		<br>
		<?php
		$query2="select * from categories;";
		$result=mysqli_query($con,$query2);
		?>
		<table border='2'>
			<tr>
				<th>
					ID
				</th>
				<th>
					NAME
				</th>
			</tr>
			<?php
			while($row=mysqli_fetch_assoc($result))
			{
				echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
              </tr>";
			}
			?>
		</table>
	</div>
	<hr>
	<?php
		if(isset($_POST['update_product'])){
			if(isset($_POST['cat_product']) && trim($_POST['cat_product'])!="" && isset($_POST['name_product']) && trim($_POST['name_product'])!="" && isset($_POST['description']) && trim($_POST['description'])!="" && isset($_POST['price']) && trim($_POST['price'])!=""  && isset($_POST['btn']) && trim($_POST['btn'])!=""){
				$target_dir = "../imgs/";
				$exploded_array = explode(".",basename($_FILES['img']['name']));
				$file_ext = strtolower(end($exploded_array));
				$target_file = $target_dir . $_POST['name_product'].'.'.$file_ext;
				$check = getimagesize($_FILES["img"]["tmp_name"]);
				if($check !== false) {
					if (file_exists($target_file)) {
						echo "Sorry, file already exists.";
					  }
					else{
						if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
							echo "Image could not be uploaded.";
						}
					}
				}
				else {
					echo "File is not an image.";
				}

				$query2= "select id from categories where name='".$_POST['cat_product']."';";
				$result=mysqli_query($con,$query2);
				$category="";
				if(mysqli_num_rows($result)!=0){
					while($row=mysqli_fetch_assoc($result)){
						$category=$row['id'];
					}

					$query= "insert into products(name,description,price,category_id,image,featured) values('".$_POST['name_product']."','".$_POST['description']."','".$_POST['price']."','".$category."','".$target_file."','".$_POST['btn']."');";
					if(!mysqli_query($con,$query)){
						echo 'Data not inserted into products table as '.mysqli_error($con);
					}

				}
				else{
					echo 'No record of category with name '.$_POST['cat_product'].' found!!';
					unlink($target_file);
				}
			}
		}
	?>
	<div class="form product-form">
		<h2>
			PRODUCTS
		</h2>
		<form action="" method="post" enctype="multipart/form-data">
			ENTER CATEGORY NAME
			<input type="text" name="cat_product" id="cat_product">
			<br>
			<br>
			ADD PRODUCT NAME
			<input type="text" name="name_product" id="name_product">
			<br>
			<br>
			ADD PRODUCT DESCRIPTION
			<textarea name="description" id="description"></textarea>
			<br>
			<br>
			ADD PRODUCT PRICE
			<input type="number" name="price" id="price">
			<br>
			<br>
			ADD PRODUCT IMAGE
			<input type="file" name="img" id="img">
			<br>
			<br>
			IS THE PRODUCT FEATURED?
			<br>
			<input type="radio" name="btn" id="yes" value="yes"><label for="yes">YES</label>
			<br>
			<input type="radio" name="btn" id="no" value="no"><label for="no">NO</label>
			<br>
			<br>
			<button type="submit" name='update_product' id='update_product'> UPDATE PRODUCT TABLE</button>
		</form>
		<br>
		<?php
		$query2='select * from products;';
		$result=mysqli_query($con,$query2);
		?>
		<table border='2'>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
			</tr>
			<?php
				while($row=mysqli_fetch_assoc($result)){
					echo "<tr>
									<td>".$row['id']."</td>
									<td>".$row['name']."</td>
									<td>".$row['description']."</td>
									<td>".$row['price']."</td>
									<td>".$row['image']."</td>
									<td>".$row['featured']."</td>
								</tr>";
				}
			?>
		</table>
	</div>
</body>
<script type="text/javascript">
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>
</html>
