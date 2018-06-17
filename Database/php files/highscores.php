<style>
<?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html>
	<head>
		<title> </title>
	</head>
	
	<body>
		<table border ='1'>
			<tr>
				<th>User</th>
				<th>Game</th>
				<th>Score</th>
				<th>Date</th>
			</tr>
			
			<?php
			require 'connect.php';
			$sql = "SELECT * from scores
					WHERE date >= (CURDATE() - INTERVAL 7 DAY)
					ORDER BY score DESC";
			$result = $con-> query($sql);

			if($result-> num_rows > 0) {
				while ($row = $result-> fetch_assoc()) {
					echo "<tr><td>". $row["player"]."</td><td>". $row["game"]."</td><td>".$row["score"]."</td><td>".$row["date"]."</td></tr>";
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