<?php
	require 'connect.php';
   
	$username = $_POST["usernamePost"];
	$email = $_POST["emailPost"];
	$password = $_POST["passwordPost"];
	$fullname = $_POST["fullnamePosT"];
	/* Open a connection */

	$query = "INSERT IGNORE INTO `account`(`email`, `password`, `fullname`) VALUES ('".$email."','".$password."','".$fullname."')";
	$result = mysqli_query($con, $query);
	
	if(!result) echo "Error spotted";
	else echo "no its ok";
?>