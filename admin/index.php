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
			if(isset($_POST['setto'])){
				$query="update categories set name='".$_POST["setto"]."' where id='".$_POST["modifyid"]."';";
				if(!mysqli_query($con,$query)){
					echo 'could not update the value as '.mysqli_error($con).'<br>';
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
		<table>
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
                <td>"
                  .$row["id"].
                "</td>
                <td>"
                  .$row["name"].
                "</td>
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
