<?php
session_start();
if(isset($_SESSION['emp_id']))
{
	session_destroy();
	header("Location: user_login.php");
}
?>