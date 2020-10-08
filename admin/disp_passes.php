<?php 
session_start();
if(!isset($_SESSION['admin_id']))
{
  header("location:index.php");
  exit();
}
$admin_id = $_SESSION['admin_id'];
require_once("../db_con.php");
?>

<?php
$pass_action = $_POST["pass_action"];
if($pass_action == "applied"){
	$query = "select * from passes where status = 'applied' order by pass_id desc";
}else if($pass_action == "rejected"){
	$query = "select * from passes where status = 'rejected' order by pass_id desc limit 30";
}else if($pass_action == "approved"){
	$query = "select * from passes where status = 'approved' order by pass_id desc limit 20";
}              
$res = @mysqli_query($conn,$query) or die("error in query ".$query);
$count = mysqli_num_rows($res);
if($count == 0){
	echo("<div class='alert alert-warning'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              No Applications to show 
              </div>");
}
else{
	while($row = mysqli_fetch_array($res)){
		$pid = $row['pass_id'];
		$p_type_id = $row['pass_type'];
		$query1 = "select * from pass_type where pass_type_id = '$p_type_id'";              
		$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
		$row1 = mysqli_fetch_assoc($res1);
		echo("<a href = 'pass_info.php?p=$pid' class='btn btn-info' style='width:100%'>".$row1['pass_type_nm']." pass ".$row['apply_date']." From ".$row['start_station']." To ".$row['dest_station']."</a><br /><br />");
	}
}
?>