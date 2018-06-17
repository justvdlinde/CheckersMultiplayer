<style>
<?php include 'style.css'; ?>
</style>

<?php

if(isset($_POST['btnLogin'])) {
	require_once 'connect.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
	$result = mysqli_query($con, 'select * from account where email ="'.$email.'" and password ="'.$password.'" LIMIT 1');
	$row = $result->fetch_assoc();
	if(mysqli_num_rows($result)==1) {
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['id']= $row['id'];
		$_SESSION['fullname'] = $row['fullname'];
		$_SESSION['username'] = $row['username'];
		header('Location: welcome.php');
	}
	else {
		echo 'Account credentials invalid';
	}
}
if(isset($_GET['logout'])) {
	session_destroy('username');
}
?>

<form method="post" >
	<table cellpadding="4" cellspacing = "4" border ="0">
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
			<td><input type="submit" name="btnLogin" value="Login"></td>	
		</tr>
	</table>
</form>

<?php echo '<a href="register.php">Register</a>' ?>