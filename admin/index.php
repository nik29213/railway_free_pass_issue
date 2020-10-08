<?php
if(isset($_SESSION["admin_id"])){

  header("location:admin_home.php");
  exit();
}
 require_once "../db_con.php"; 
 $logerr = "";     
 if($conn)
 {
  if(isset($_POST["admin_login"])){
    $emp_id=$_POST['emp_id'];
    $password=md5($_POST['password']);
    if($emp_id=='' || $password=='')
    {
      $logerr = "email id and password both are required";
    }
    else
    {
      $query="SELECT * FROM admin WHERE username='$emp_id' AND password='$password'";
      $exec_query=mysqli_query($conn,$query);
      $s=mysqli_num_rows($exec_query);
      if($s>=1)
      {
        session_start();
        $_SESSION['admin_id']=$emp_id;
        header("location: admin_home.php");
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
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- bootstrap cdn-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>

</head>
<body>

  
  <div class ="container-fluid">
    <div class = "row">
      <div class = "col-sm-3"></div>
      <div class = "col-sm-6">
        <form action="" method="post">
          <br /><br />
          <div class="jumbotron" style="background-size: "10px!impotant";>
			<br /><br />
			<center><h2>Login</h2></center>
			<br />
            <label for="uname"><b>Username</b></label>
            <input type="text" class = "form-control" placeholder="Enter Username" name="emp_id" required>
<br />
            <label for="psw"><b>Password</b></label>
            <input type="password" class = "form-control" placeholder="Enter Password" name="password" required>
             <br /><br /> 
            <center><span style="color:red;"><?php echo($logerr); ?></span></center>
  
            <center><button type="submit"  class="btn btn-success btn-lg" value='login' name="admin_login">Login</button></center>
            
          </div>

          
        </form>
      </div>
      <div class = "col-sm-3"></div>

    </div>
  </div>
</body>
</html>
