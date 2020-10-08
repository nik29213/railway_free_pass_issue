
<?php
require_once "db_con.php"; 
 $logerr = "";
 $loger="";  
if($conn)
{
			if(isset($_POST["submit"]))
			{
			$emp_id=$_POST['emp_id'];
			$password=$_POST['password'];
			$confirm_password=$_POST['confirm_password'];

	/*if($emp_id==''|| $password==''||$confirm_password=='')
	{
		$logerr = "incomplete credentials";
		exit;
	}
	else
	{*/
		if($password == $confirm_password)
		{
			$query="INSERT INTO table1 VALUES('$emp_id','".md5($password)."')";
			$exec_query=mysqli_query($conn,$query);
			if ($exec_query) 
			{
				$logerr = "user created..."; 
				 $logerr="<a href='user_login.php'>now u can login</a>";
			}
			else
			{
				$logerr = "confirm your password error occured";
			}
		}
		else
			{
				$logerr = "confirm your password";
			}
	
}
}


?>  




<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="js/bootstrap.css">-->
<meta http-equiv="content-type" content="text/html:charset=utf-8" />

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
			<!--<div class="col-sm-5">-->
				<div class="col-sm-3"></div>
			<div class="col-sm-6">

				<h2 class="text-center">Employee's registration</h2>
				<form action=' ' method='post'>
					<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					    <input type="emp_id" class="form-control" name="emp_id" placeholder="emp_id" required="">
					</div>
					<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					    <input type="password" class="form-control" name="password" placeholder="Password" required="">
					</div>
										
					
					<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					    <input type="password" class="form-control" name="confirm password" placeholder="confirm Password">
					 </div>
					<br>
					
						<center>
						<input type='submit' type="submit" class="btn btn-primary btn-lg" value='submit'name="submit">

						<br /></center>
						<center>
						<span style="color:red;">
							<?php echo($logerr);?><br>
						 <?php echo($loger);
						 ?>
						</span></center>
				</form>
			</div>
			</div>
		</div> 
	</div>
</body>
</html>