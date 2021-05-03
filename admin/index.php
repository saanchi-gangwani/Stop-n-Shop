<?php
require(__DIR__."/../config/connection.php");
$con=mysqli_connect($host,$username,$password,$dbname) or die("Could not connect to database");
$query="insert into categories(name) values('".$_POST["name"]."');";
mysqli_query($con,$query);
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
			DELETE
			<input type="text" name="toremove" id="toremove">
			<button type="submit"> UPPDATE </button>

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
		<?php 
		$query3="update categories set name='".$_POST["setto"]."' where id='".$_POST["modifyid"]."';";
		mysqli_query($con,$query3);
		$query4="delete from categories where id='".$_POST["toremove"]."';";
		mysqli_query($con,$query4);
		?>
	</div>
</body>
</html>
