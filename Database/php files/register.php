<style>
<?php include 'style.css'; ?>
</style>
<?php
if(isset($_POST['btnRegister'])) {
	require_once 'connect.php';
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);	
	$query = "INSERT IGNORE INTO `account`(`fullname`, `username`, `email`, `password`) VALUES ('".$fullname."','".$username."','".$email."','".$password."')";
	$result = mysqli_query($con, $query);
	session_start();
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title> </title>
	</head>
	<body>
	
		<form method="post" >
			<table cellpadding="4" cellspacing = "4" border ="0">
				<tr>
					<td>Full Name</td>
					<td><input type="text" name="fullname"></td>	
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username"></td>	
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email"></td>	
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></td>	
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="btnRegister" value="Register"></td>	
				</tr>
			</table>
		</form>
		
	</body>
</html>