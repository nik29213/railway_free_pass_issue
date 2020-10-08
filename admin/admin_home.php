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
	    <div class = "container-fluid">
	    	<div class = "row">
	    		<div class="col-sm-1"></div>
	    		<div class="col-sm-3">
	    			<button id = 'btn_applied' class = "btn btn-primary btn_passes" action = 'applied' style = "width:80%">Applied Passes</button><br/>
	    			<button id = 'btn_approved' class = "btn btn-primary btn_passes" action = 'approved' style = "width:80%">Approved Passes</button><br/>
	    			<button id = 'btn_rejected' class = "btn btn-primary btn_passes" action = 'rejected' style = "width:80%">Rejected Passes</button><br/>
	    		</div>
	    		<div class = "col-sm-7">
	    			<div id = "show_passes" class = "container-fluid">

	    			</div>
	    		</div>
	    		<div class="col-sm-1"></div>

	    	</div>
	    </div>
	</body>
</html>