<?php 
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}
$emp_id = $_SESSION['emp_id'];
require_once("../db_con.php");
?>


<html>

	  <head>

	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="../style.css">

	    <!--bootstrap files-->
	    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
	    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	    <!--zone-->


	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src = "js/main.js"></script>
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
		          <li><a href="../welcome.php"> <i class="fa fa-home"></i> Home</a></li>
		          <li><a href = "../family.php"><i class="fa fa-group" aria-hidden="true"></i> Family Details</a></li>
		          <li><a href="../apply_pass.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Apply passes</a></li>
		          <li class = "active"><a href="../pass_status.php"><i class="fa fa-check-square" aria-hidden="true"></i> Pass status</a></li>
		        </ul>
		        <ul class="nav navbar-nav navbar-right">
		          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		        </ul>
		    </div>
	    </nav>
	    <div class="container-fluid">
	    	<div class = "row">
	    		<div class = "col-sm-2"></div>

	    		<div class = "col-sm-8">
	    			<span class="text-info"><h3><b>Pass details</b></h3></span>
			    	<div class="table-repsonsive">
					    <table class="table table-bordered" id="item_table">
					      	<?php
					      	$pid = $_GET["p"];
					      	$query = "select * from passes where pass_id = '$pid'";              
		    				$res = @mysqli_query($conn,$query) or die("error in query ".$query);
		    				$row = mysqli_fetch_assoc($res);
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
					if($status == "approved"){
						echo("<center><a type ='button' href = 'dwnld_pdf.php?p=$pid' class ='btn btn-success'>View</a>&nbsp;");
						echo("<a type ='button' href = 'dwnld_pdf.php?p=$pid' class ='btn btn-success' download>Download Pass</a></center>");

					}
					?>
				</div>
				<div class = "col-sm-2"></div>
			</div>
	    </div>
	</body>
</html>