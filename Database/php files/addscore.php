<style>
<?php include 'style.css'; ?>
</style>
<?php
require_once 'connect.php';
session_start();
$id = $_SESSION['id'];

if(isset($_POST['btnSubmitScore'])) {
	$score = $_POST['score'];
	$username = $_SESSION['username'];
	$game = $_POST['game'];
	$query = "INSERT IGNORE INTO `scores`(`player`, `game`, `score`) VALUES ('".$username."','".$game."','".$score."')";
	$result = mysqli_query($con, $query);
	header('Location: welcome.php');
}
?>

<html>
	<head>
		<title> </title>
	</head>
	<body>
		<form name = "Games" action = "" method="post" >
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
			<table cellpadding="4" cellspacing = "4" border ="0">
				<tr>
					<td>Score</td>
					<td><input type="text" name="score"></td>	
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="btnSubmitScore" value="Register"></td>	
				</tr>
			</table>
		</form>
		<br/><a href="welcome.php">Back</a>
	</body>
</html>