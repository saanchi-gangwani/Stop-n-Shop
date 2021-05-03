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
			CATEGORY NAME
			<input type="text" name="name" id="name">
			<button type="submit">ADD</button>
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
				echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td></tr>";
			}
			?>
		</table>
	</div>
</body>
</html>
