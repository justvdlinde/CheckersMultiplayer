<style>
<?php include 'style.css'; ?>
</style>
<?php

session_start();
$id = $_SESSION['id'];

if(isset($_POST['btnEdit'])) {
	require_once 'connect.php';
	$new_fullname = $_POST['new_fullname'];
	$new_username = $_POST['new_username'];
	$new_email = $_POST['new_email'];
	$new_password = $_POST['new_password'];
	$new_email = filter_var($new_email, FILTER_SANITIZE_EMAIL);
	$new_password = filter_var($new_password, FILTER_SANITIZE_SPECIAL_CHARS);	
	$query = "UPDATE account
			SET email = '$new_email', password = '$new_password', fullname = '$new_fullname', username = '$new_username' 
			WHERE id =".$_SESSION['id'];
	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title> </title>
	</head>
	<body>
	
		<form method="post" action = "?">
			<table cellpadding="4" cellspacing = "4" border ="0">
				<tr>
					<td>New Full Name</td>
					<td><input type="text" name="new_fullname"></td>	
				</tr>
				<tr>
					<td>New Username</td>
					<td><input type="text" name="new_username"></td>	
				</tr>
				<tr>
					<td>New Email</td>
					<td><input type="text" name="new_email"></td>	
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type="password" name="new_password"></td>	
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="btnEdit" value="Register"></td>	
				</tr>
			</table>
		</form>
	<br/><a href="welcome.php">Back</a>	
	</body>
</html>