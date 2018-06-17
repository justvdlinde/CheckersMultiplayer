<?php
	require 'connect.php';
	
	$user_email = $_POST["emailPost"];
	$user_password = $_POST["passwordPost"];
	
	$query = "SELECT password FROM account WHERE email = '".$user_email."' ";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			if($row['password'] == $user_password) {
				echo "login success";
				
			} else { 
				echo "password incorrect";
			}		
		}
	} else {
		echo "user not found";
	}
	
	
?>