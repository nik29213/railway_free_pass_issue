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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
.navbar-brand>img {
   max-height: 100%;
   height: 100%;
   width: auto;
   margin: 0 auto;


   /* probably not needed anymore, but doesn't hurt */
   -o-object-fit: contain;
   object-fit: contain; 

}
</style>
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
        <li class="active"><a href="#"> <i class="fa fa-home"></i> Home</a></li>
        <li><a href = "family.php"><i class="fa fa-group" aria-hidden="true"></i> Family Details</a></li>
        <li><a href="apply_pass.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Apply passes</a></li>
        <li><a href="pass_status.php"><i class="fa fa-check-square" aria-hidden="true"></i> Pass status</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </nav>

  <!------------------------------form start------------------------------------------------>
    <div class="container" style="background-color: #5DADE2">

      <form class="well form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset style="color: #5DADE2">

          <!-- Form Name -->
          <legend>Personal Details</legend>

          <!-- Text input-->
          <?php
          $query = "select * from personal where emp_id = '$emp_id'";                
          $res = @mysqli_query($conn,$query) or die("error in query ".$query);
          $row = mysqli_fetch_assoc($res);
                              
          ?>

          <div class="form-group">
            <label class="col-md-4 control-label">First Name</label>  
            <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="first_name" placeholder="First Name" class="form-control"  type="text" required disabled value = "<?php echo($row['first_name']); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->

          <div class="form-group">
            <label class="col-md-4 control-label" >Last Name</label> 
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="last_name" placeholder="Last Name" class="form-control"  type="text" required disabled  value = "<?php echo($row['last_name']); ?>">
              </div>
            </div>
          </div>

          <!-- radio checks -->
           <div class="form-group">
              <label class="col-md-4 control-label">gender</label>
                <div class="col-md-4">
                  <?php 
                    $gender = $row['gender'];
                      if($gender == 'm')
                        $g = "male";
                      else
                        $g = "female";
                  ?>
                  <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="gender" class="form-control"  type="text" required disabled  value = "<?php echo($g); ?>">
              </div>
              <!--gender radios-->
                    <div class="radio disp-none">
                      <label>
                        <input type="radio" name="gender" value="m" selected/> male
                      </label>

                    </div>
                    <div class="radio disp-none">
                      <label>
                        <input type="radio" name="gender" value="f" /> female
                      </label>
                    </div>
               </div>
            </div>


          <!--office zone select-->
          <div class="form-group"> 
            <label class="col-md-4 control-label">office zone</label>
              <div class="col-md-4  inputGroupContainerr">
                
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                      <input name="office" class="form-control"  type="text" required disabled  value = "<?php echo($row['office_zone']); ?>">
                  </div>
                
          
              <div class="input-group disp-none">
                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                  <select name="office zone" class="form-control selectpicker"  style="color: #BB8FCE" >
                    <option value=" ">Please select your zone</option>
                    <option value="dhanbad">dhanbad</option>
                    <option value="jamshedpur">jamshedpur</option>
                    <option value="ranchi">ranchi</option>
                    <option value="bokaro">bokaro</option>
                    <option value="deoghar">deoghar</option>
                    <option value="dumka">dumka</option>
                  </select>
              </div>

            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">E-Mail</label>  
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input name="Email" placeholder="E-Mail Address" class="form-control"  type="text" required disabled  value = "<?php echo($row['Email']); ?>">
              </div>
            </div>
          </div>


          <!-- Text input-->
                 
          <div class="form-group">
            <label class="col-md-4 control-label">Phone</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="Phone" placeholder="(845)555-1212" class="form-control" type="text" required disabled  value = "<?php echo($row['Phone']); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
                
          <div class="form-group">
            <label class="col-md-4 control-label">Address</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="Address" placeholder="Address" class="form-control" type="text" required disabled  value = "<?php echo($row['Address']); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
           
          <div class="form-group">
            <label class="col-md-4 control-label">City</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="City" placeholder="city" class="form-control"  type="text" required disabled  value = "<?php echo($row['City']); ?>">
              </div>
            </div>
          </div>

          <!-- Select Basic -->
             
          <div class="form-group"> 
            <label class="col-md-4 control-label">State</label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                      <input name="office" class="form-control"  type="text" required disabled  value = "<?php echo($row['State']); ?>">
                  </div>
                </div>
          
            <div class="col-md-4 selectContainer disp-none">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                <select name="State" class="form-control selectpicker"  style="color: #BB8FCE" required="">
                  <option value=" ">Please select your state</option>
                  <option value="dhanbad">dhanbad</option>
                  <option value="jamshedpur">jamshedpur</option>
                  <option value="ranchi">ranchi</option>
                  <option value="bokaro">bokaro</option>
                  <option value="deoghar">deoghar</option>
                  <option value="dumka">dumka</option>
                </select>
              </div>
            </div>
          </div>


          <!-- Text input-->

          <div class="form-group">
            <label class="col-md-4 control-label">Zip Code</label>  
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="zip" placeholder="Zip Code" class="form-control"  type="text" required disabled  value = "<?php echo($row['Zip']); ?>">
                </div>
              </div>
          </div>

          
          <!-- Success message -->
          <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.
          </div>


          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
            </div>
          </div>

          </fieldset>
      </form>
    </div>
  </body>
</html>