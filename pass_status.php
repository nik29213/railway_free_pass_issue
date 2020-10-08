<?php 
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}
$emp_id = $_SESSION['emp_id'];
require_once("db_con.php");
?>


<html>

	  <head>

	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="style.css">

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
		            <img src="image/logo.png"/>
		          </a>
		        </div>
		        <ul class="nav navbar-nav">
		          <li><a href="welcome.php"> <i class="fa fa-home"></i> Home</a></li>
		          <li><a href = "#"><i class="fa fa-group" aria-hidden="true"></i> Family Details</a></li>
		          <li><a href="apply_pass.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Apply passes</a></li>
		          <li class = "active"><a href="pass_status.php"><i class="fa fa-check-square" aria-hidden="true"></i> Pass status</a></li>
		        </ul>
		        <ul class="nav navbar-nav navbar-right">
		          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		        </ul>
		    </div>
	    </nav>
	    <div class="container-fluid">
	    	<div class="table-repsonsive">
			   	<span id="error"></span>
			    <table class="table table-bordered" id="item_table">
			      	<tr>
				       	<th>From</th>
				       	<th>To</th>
				       	<th>Applied on (yyyy-mm-dd)</th>
				       	<th>Pass</th>
				       	<th>one way/round trip</th>
				       	<th>status</th>
			      	</tr>
			      	<?php
			      	$query = "select * from passes where emp_id = '$emp_id' order by pass_id desc";                
    				$res = @mysqli_query($conn,$query) or die("error in query ".$query);
    				while($row = mysqli_fetch_array($res)){
    					$pid = $row['pass_id'];
                      echo("<td>".$row['start_station']."</td>");
                      echo("<td>".$row['dest_station']."</td>");
                      echo("<td>".$row['apply_date']."</td>");

                      	$ptid = $row['pass_type'];
                      	$query1 = "select * from pass_type where pass_type_id = '$ptid'";                
    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
    					$row1 = mysqli_fetch_assoc($res1);
                    
                      echo("<td>".$row1['pass_type_nm']."</td>");
                      	if($row['half_full'] == '1')
                      		$txt = "one way";
                      	else
                      		$txt = "round trip";
                      echo("<td>".$txt."</td>");
                      echo("<td><b><a href ='php/view_pass.php?p=$pid'>".$row['status']."</a></b></td></tr>");

                    }
                    
			      	?>
			     </table>
			</div>
	    </div>

	</body>
</html>