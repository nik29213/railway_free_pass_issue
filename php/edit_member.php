<?php
require_once("../db_con.php");
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}
	$emp_id = $_SESSION['emp_id'];
	$nm = $_POST["mem_nm"];
    $age = $_POST["mem_age"];
  	$rlsn = $_POST["mem_rlsn"];
  	$fid = $_POST["fid"];

  	$query = "UPDATE `family_details` SET `Full_name`='$nm',`Age`='$age',`relationship`='$rlsn'";
  	$new_file_nm = $emp_id . "_" . $nm;

	if(isset($_FILES['file_id'])){
    	$fileid = $new_file_nm . "_id.pdf";
    	move_uploaded_file($_FILES['file_id']['tmp_name'], '../uploads/' . $fileid);
    	$query .= ",Id_Proof = '$fileid'";

	}
    if(isset($_FILES['file_med'])){
    	$filemed = $new_file_nm . "_med.pdf";
    	move_uploaded_file($_FILES['file_med']['tmp_name'], '../uploads/' . $filemed);
    	$query .= ",Medical_Proof = '$filemed'";

    }
    $query .= " where fid = '$fid'";
    $exec_query=mysqli_query($conn,$query);
			if ($exec_query) 
			{
				$err = "family member details updated"; 
			}
			else
			{
				$err = mysqli_error($conn);
			}
			echo $err;
        
    
?>