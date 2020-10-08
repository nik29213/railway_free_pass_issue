<?php
require_once("../db_con.php");
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}

	$emp_id = $_SESSION['emp_id'];
	if(isset($_POST["chk_max"])){
    $pid = $_POST["pass_type"];

    $query = "select * from pass_type where pass_type_id = '$pid'";
    $res = @mysqli_query($conn,$query) or die("error in query ".$query);
    $row = mysqli_fetch_assoc($res);
    $max_pass = $row["max_pass"];

    $yr = date("Y");
    $query = "select * from passes where emp_id = '$emp_id' and issue_year = '$yr' and pass_type = '$pid'";                
    $res = @mysqli_query($conn,$query) or die("error in query ".$query);
    $count = mysqli_num_rows($res);
    if($count < $max_pass)
      echo("possible");
    else
      echo("<div class='alert alert-warning'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Sorry</strong> you have already applied for the chosen pass type for ".$max_pass." times.
              You can check for other suitable passes
            </div>
        ");
  }  
?>