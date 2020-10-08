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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!--zone-->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src = "js/pass.js"></script>
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
          <li><a href = "family.php"><i class="fa fa-group" aria-hidden="true"></i> Family Details</a></li>
          <li class="active"><a href="apply_pass.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Apply passes</a></li>
          <li><a href="pass_status.php"><i class="fa fa-check-square" aria-hidden="true"></i> Pass status</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class = "row">
        <div class = "col-sm-2">
        </div>
        <div class="col-sm-8">
          <h3><span class="txt-blk"><b>Apply Passes</b></span></h3>
          <div class = "container-fluid" id = "div_apply_pass">

            <form id="myform" name="myform" method = "post">
              <br />
              <h4>Pass type</h4>
              <select id = "priv_type" name = "priv_type" class = "form-control">
                <option value = "-1" disabled selected>Select pass type</option>
                <?php
                  $query = "select * from personal where emp_id = '$emp_id'";
                  $res = @mysqli_query($conn,$query) or die("error in query ".$query);
                  $row = mysqli_fetch_assoc($res);
                  $class_type = $row["class_type_id"];

                  $query = "select * from pass_type where class_type_id = '$class_type'";                
                  $res = @mysqli_query($conn,$query) or die("error in query ".$query);
                  while($row = mysqli_fetch_array($res)){
                    echo("<option value = '".$row['pass_type_id']."'>".$row['pass_type_nm']."</option>");
                  } //end of while   
                ?>
              </select><!--end of pass type-->
              <br />
              <div class = "container-fluid disp-none" id = "inner_div_apply_pass">
                <div class = "row">
                  <div class = "col-sm-6">
                    <h4>Source station</h4>
                    <input name="source" type ="text" class="form-control source" />
                    <br />
                  </div>
                  <div class = "col-sm-6">
                    <h4>Destination station</h4>
                    <input name="dest" type ="text" class="form-control dest" />
                    <br />
                  </div>
                </div>
                <!--2nd row----------------->
                <div class = "row">
                  <div class = "col-sm-6">
                    <h4>One way/Round trip</h4>
                    <select name = "one_round" id ="one_round" class= "form-control">
                      <option value = "1">One way</option>
                      <option value = "2">Round trip</option>
                    </select>
                  </div>
                  <div class = "col-sm-6">
                    <h4>Passengers</h4>
<!----------------------------------------------------------------------------------------------->
                    <input type='checkbox' class = 'members' name='members[]' value = '0'> self<br />
                    <?php
                    $query = "select * from family_details where emp_id = '$emp_id'";                
                    $res = @mysqli_query($conn,$query) or die("error in query ".$query);
                    while($row = mysqli_fetch_array($res)){
                      echo("<input type='checkbox' class = 'members' name='members[]' value = '".$row['fid']."'> ".$row['Full_name']."<br />");
                    }
                    ?>
<!------------------------------------------------------------------------------------------------->
                  </div><!--end of col-sm-6-->
                </div><!--end of row-->
                <br />
                <center><input type = "button" id = "btn_pass" value = "submit" name = "submit" class = "btn btn-success"/></center>
              </div><!--end of inner div apply pass-->
            </form>
          </div>
        </div>
        <div class = "col-sm-2">
        </div>
      </div>
    </div><!--end of container fluid-->
    <br /><br />        
  </body>
</html>
