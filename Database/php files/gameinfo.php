<style>
<?php include 'style.css'; ?>
</style>
<?php
require_once 'connect.php';
session_start();
$id = $_SESSION['id'];


?>

<html>
	<head>
		<title> </title>
	</head>
	<body>
		<form name = "Games" action = "" method="post" >
			<p>Game Name</br>
			<select name = "game" id = "game">
				<?php
					$query_game = mysqli_query($con, "select * from Games");
					while ($row = mysqli_fetch_array($query_game)) {
				?>
				<td>Game</td>
				<option>
					<?php echo $row["NAME"]; ?>
				</option>
				<?php }	?>
			</select>
			</p>
			<p>Highscore List</br>
			<select name = "highscore" id = "highscore">
				<option value = "1"> 1 day </option>
				<option value = "7"> 1 week </option>
				<option value = "30"> 1 month </option>
				<option value = "999"> All-time </option>
			</select>
			</p>
			<table cellpadding="4" cellspacing = "4" border ="0">
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="btnRequestGameInfo" value="Get Info"></td>	
				</tr>
			</table>
			<?php
			if(isset($_POST['btnRequestGameInfo'])) {
				echo "Number of times this game is played last week: ";
				$query = "SELECT COUNT(*) c 
							FROM  scores
							WHERE date >= ( CURDATE() - INTERVAL 7 DAY )
							AND game = '".$_POST['game']."'";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
				echo $row['c']. "</br>"."</br>";
				echo "Top 10 highscores: ";
				?>
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
					WHERE date >= (CURDATE() - INTERVAL '".$_POST['highscore']."' DAY)
					AND game = '".$_POST['game']."'
					ORDER BY score DESC
					LIMIT 10";
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
			?>
			<?php }; ?>
					
				</table>
		</form>
		

		<br/><a href="welcome.php">Back</a>
	</body>
</html>