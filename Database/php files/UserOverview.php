<style>
<?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html>
	<head>
		<title> </title>
	</head>
	
	<body>
		<table>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Full Name</th>
			</tr>
			
			<?php
			require 'connect.php';
			$sql = "SELECT username, email, fullname from account";
			$result = $con-> query($sql);
			
			if($result-> num_rows > 0) {
				while ($row = $result-> fetch_assoc()) {
					echo "<tr><td>". $row["username"]."</td><td>". $row["email"]."</td><td>".$row["fullname"]."</td></tr>";
				}
				echo "</table>";
			}
			else {
				echo "No Result";
			}
			
			echo '<br/><a href="welcome.php">Back</a>'
			?>
		</table>
	</body>
	
</html>