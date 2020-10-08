<?php
if(isset($_SESSION["emp_id"])){

	header("location:welcome.php");
	exit();
}
 require_once "db_con.php"; 
 $logerr = "";     
 if($conn)
 {
 	if(isset($_POST["login"])){
	 	$emp_id=$_POST['emp_id'];
	 	$password=md5($_POST['password']);
	 	if($emp_id=='' || $password=='')
	 	{
	 		$logerr = "email id and password both are required";
	 	}
	 	else
	 	{
	 		$query="SELECT * FROM personal WHERE emp_unique_id='$emp_id' AND password='$password'";
	 		$exec_query=mysqli_query($conn,$query);
	 		$s=mysqli_num_rows($exec_query);
	 		if($s>=1)
	 		{
	 			$row=mysqli_fetch_assoc($exec_query);
	 			session_start();
	 			$_SESSION['emp_id'] = $row["emp_id"];
	 			header("location: welcome.php");
	 		}
	 		else
	 		{
	 			$logerr = "either email id or password doesn't exist";
	 		}
	 	}
 	}
 }
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="content-type" content="text/html:charset=utf-8" />
<!--prograss bar-->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- bootstrap cdn-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#emp_id').keyup(function()
			{
				$.post("avail_user.php",
					{emp_id : $('#emp_id').val()
					 },function(response)
					{
						$('#emp_idResult').fadeOut();
						setTimeout("closeajax('emp_idResult','"+escape (response)+"')",350);
					});
					return false;
			
		});
	});
	function emp_idresult(id,response)
	{
		$('#emp_id').hide();
		$('#'+id).html(unescape(response));
		$('#'+id).fadeIn();
	}
</script>
 <title> mini project</title>
	
</head>
<body>

	<div class="container">
		<div class="row">
			<div class ="col-sm-3"></div>
			<div class="col-sm-6">

				<h2 class="text-center" style = "color:white">Employee's login</h2>
				<br /><br />
				<form action='' method='post'>

					<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					    <input type="text" class="form-control" name="emp_id" placeholder="Enter your id">
					</div>
					<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					    <input type="password" class="form-control" name="password" placeholder="Password">
					</div> 

					<br>
					<center><span style="color:red;"><?php echo($logerr); ?></span></center>
					<center>
						<input type='submit' class="btn btn-primary btn-lg" value='login' name="login">		
						<br />	
						<a href = "user_reg.php" class="text-center">not a member yet? please reg urself</a>
						
						<div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40%
    </div>
					</center>
				</form>
			</div>



			<div class="col-sm-3"></div>
			
		</div> 
	</div>
</body>
</html>