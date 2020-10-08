<?php
	session_start();
	if(!isset($_SESSION["emp_id"]) || !isset($_POST["del_id"])){
		exit("error");
		header("location:../welcome.php");
		exit();
	}
	require("../db_con.php");
	$fid = $_POST["del_id"];
	$query = "DELETE from family_details where fid='$fid';";
	@mysqli_query($conn,$query) or die(mysqli_error($conn));
	echo("success");
?>