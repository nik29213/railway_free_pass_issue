<?php
require_once("../db_con.php");
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}

$emp_id = $_SESSION['emp_id'];

if( isset( $_POST['members'] ))
{
	$dt = date("Y-m-d");
	$strt =$_POST['source']; 
	$dest = $_POST['dest'];
	$pass_type = $_POST['priv_type'];
	$one_round = $_POST['one_round'];

	$query="INSERT INTO passes VALUES('','$emp_id','$dt','','','$strt','$dest','$pass_type','$one_round','applied')";
	$exec_query=mysqli_query($conn,$query);

	if ($exec_query) 
	{
		$query = "select * from passes where emp_id = '$emp_id' order by pass_id desc limit 1";                
    	$res = @mysqli_query($conn,$query) or die("error in query ".$query);
    	$row = mysqli_fetch_assoc($res);

    	$pid = $row["pass_id"];
		for ( $i=0; $i < count( $_POST['members'] ); $i++ )
    		{
    			$fid = $_POST['members'][$i];
    			if($fid == 0)
    					$query="INSERT INTO pass_family VALUES('','$pid','$fid','self')";
    			else
    				    $query="INSERT INTO pass_family VALUES('','$pid','$fid','family')";
    			$exec_query=mysqli_query($conn,$query);
    			if($exec_query)
    				$msg = "<div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Pass applied successfully</div>";

    		}
	}
	else
	{
		$msg = mysqli_error($conn);
	}
	echo($msg);
}

?>