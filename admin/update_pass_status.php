<?php
require_once("../db_con.php");
session_start();
if(!isset($_SESSION['admin_id']))
{
  header("location:index.php");
  exit();
}
	$emp_id = $_SESSION['admin_id'];
	$pass_action = $_POST["pass_action"];
  $pid = $_POST["pid"];
  $dt = date("Y-m-d");
  $yr = date("Y");

  	$query = "UPDATE passes set approval_date = '$dt',issue_year = '$yr',status = '$pass_action' where pass_id = '$pid'";

    $exec_query=mysqli_query($conn,$query);
			if ($exec_query) 
			{
				if($pass_action == "approved")
          $err = "<div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Application is successfully approved now
              </div>";
        else if($pass_action == "rejected")
          $err = "<div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Application is Rejected
              </div>";
        
			}
			else
			{
				$err = mysqli_error($conn);
			}
			echo $err;
        
    
?>