<?php 
session_start();
if(!isset($_SESSION['admin_id']))
{
  header("location:admin_login.php");
  exit();
}
$admin_id = $_SESSION['admin_id'];
require_once("../db_con.php");
?>

<html>
	  <head>

	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="../style.css">

	    <!--bootstrap files-->
	    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	    <!--zone-->


	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src = "../js/admin.js"></script>
	  </head>


	<body>

	    <nav class="navbar navbar-inverse" style = "border-radius:0px">
		    <div class="container-fluid">
		        <div class="navbar-header">
		          <a class="navbar-brand" href="#">
		            <img src="../image/logo.png"/>
		          </a>
		        </div>
		        <ul class="nav navbar-nav">
		          <li class = "active"><a href="admin_home.php"> <i class="fa fa-home"></i> Home</a></li>
		          <li class = "active"><a href = ""><i class="fa fa-user" aria-hidden="true"></i> Welcome admin</a></li>
		        </ul>
		        <ul class="nav navbar-nav navbar-right">
		          <li><a href="admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		        </ul>
		    </div>
	    </nav>
	    <br />
	    <div class="container-fluid">
	    	<div class = "row">
	    		<div class = "col-sm-2"></div>

	    		<div class = "col-sm-8" id = "alert_status">
	    			<span class="text-info"><h3><b>Pass details</b></h3></span>
			    	<div class="table-repsonsive">
					    <table class="table table-bordered" id="item_table">
					      	<?php
					      	$pid = $_GET["p"];
					      	$query = "select * from passes where pass_id = '$pid'";              
		    				$res = @mysqli_query($conn,$query) or die("error in query ".$query);
		    				$row = mysqli_fetch_assoc($res);
		    					$emp_id = $row['emp_id'];
		                      echo("<tr><th>From</th><td>".$row['start_station']."</td></tr>");
		                      echo("<tr><th>To</th><td>".$row['dest_station']."</td></tr>");
		                      echo("<tr><th>Applied on </th><td>".$row['apply_date']."</td></tr>");

		                      	$ptypeid = $row['pass_type'];
		                      	$query1 = "select * from pass_type where pass_type_id = '$ptypeid'";                
		    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
		    					$row1 = mysqli_fetch_assoc($res1);
		                    
		                      echo("<tr><th>Pass type</th><td>".$row1['pass_type_nm']."</td></tr>");
		                      	if($row['half_full'] == '1')
		                      		$txt = "one way";
		                      	else
		                      		$txt = "round trip";
		                      echo("<tr><th>one way/round trip</th><td>".$txt."</td></tr>");
		                      echo("<tr><th>Status</th><td><h3><b>".$row['status']."</b></h3></td></tr>");
		                      $status = $row['status'];
					      	?>
					    </table>
					</div>

					<!----------------passenger--------->
					<span class="text-success"><h3>Passenger</h3></span>
			    	<div class="table-repsonsive">
					    <table class="table table-bordered" id="item_table">
					    	<tr class = 'text-info'><th>Full name</th><th>Age</th><th>Relationship</th></tr>
					      	<?php
					      	$pid = $_GET["p"];
					      	$query = "select * from pass_family where pass_id = '$pid'";              
		    				$res = @mysqli_query($conn,$query) or die("error in query ".$query);
		    				while($row = mysqli_fetch_assoc($res)){
		    					$fid = $row["family_id"];

		                      	if($fid != 0){
			                      	$query1 = "select * from family_details where fid = '$fid'";                
			    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
			    					$row1 = mysqli_fetch_assoc($res1);
			                      	echo("<tr><th>".$row1['Full_name']."</th><td>".$row1['Age']."</td><td>".$row1['relationship']."</td></tr>");
		                      	}else{
		                      		$query1 = "select * from personal where emp_id = '$emp_id'";                
			    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
			    					$row1 = mysqli_fetch_assoc($res1);
			                      	echo("<tr><th>".$row1['first_name']."</th><td>".$row1['age']."</td><td>self</td></tr>");
		                      	}		                      	
		                    }
					      	?>
					    </table>
					</div>

					<!---------------end of passenger-------------------->
					<?php
					if($status == "applied"){
						echo("<center><a type ='button' pass='$pid' action='rejected' class ='btn btn-success reject_approve'>Reject</a>&nbsp;");
						echo("<a type ='button' pass='$pid' action='approve' class ='btn btn-success reject_approve'>Approve</a></center>");
					}
					else if($status == "rejected"){
						echo("<a type ='button' pass='$pid' action='approved' class ='btn btn-success reject_approve'>Approve</a></center>");
					}
					?>
				</div>
				<div class = "col-sm-2"></div>
			</div>
	    </div>

	</body>
</html>