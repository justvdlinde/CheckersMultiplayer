<?php

	require 'connect.php';
	$score = $_POST["scorePost"];
	
	if(!$con){
		die("Connection Failed. ". mysqli_connect_error());
	}
	
	$sql = "INSERT INTO scores (game, score) 
			VALUES (`Chess`,'".$score."')";
	$result = mysqli_query($con, $sql);
	
	if(!result) echo "Error spotted";
	else echo "no its ok";


?>