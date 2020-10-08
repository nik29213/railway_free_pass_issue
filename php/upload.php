<?php
require_once("../db_con.php");
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}
	$emp_id = $_SESSION['emp_id'];
    if ((0 < $_FILES['file_id']['error']) || (0 < $_FILES['file_med']['error'])) {
        echo 'Error: ' . $_FILES['file_id']['error'] . '<br>';
    }
    else {
    	$nm = $_POST["mem_nm"];
     	$age = $_POST["mem_age"];
    	$rlsn = $_POST["mem_rlsn"];

    	$new_file_nm = $emp_id . "_" . $nm;
    	$fileid = $new_file_nm . "_id.pdf";
    	$filemed = $new_file_nm . "_med.pdf";
    	
        //move_uploaded_file($_FILES['file_id']['tmp_name'], '../uploads/' . $_FILES['file_id']['name']);
        move_uploaded_file($_FILES['file_id']['tmp_name'], '../uploads/' . $fileid);
        move_uploaded_file($_FILES['file_med']['tmp_name'], '../uploads/' . $filemed);

			$query="INSERT INTO family_details VALUES('','$emp_id','$nm','$age','$rlsn','$fileid','$filemed')";
			$exec_query=mysqli_query($conn,$query);
			if ($exec_query) 
			{
				$err = "family member added"; 
			}
			else
			{
				$err = mysqli_error($conn);
			}
			echo $err;
        

    }

?>