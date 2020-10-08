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
          <li class="active"><a href = "#"><i class="fa fa-group" aria-hidden="true"></i> Family Details</a></li>
          <li><a href="apply_pass.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Apply passes</a></li>
          <li><a href="pass_status.php"><i class="fa fa-check-square" aria-hidden="true"></i> Pass status</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class = "row">
        <div class = "col-sm-1">
        </div>
        <div class="col-sm-10">
          <h3><span class="txt-blk"><b>Family details</b></span></h3>
            
            <!-- + symbol for adding new member--> 
            <div class="pull-right" id="add_new_mem" style="margin-top:0px !important;">
              <a href="#">
                <h1><i class = "fa fa-plus-circle"></i></h1>
              </a>
            </div>
            <div class="clearfix">
            </div>
            <!--end of + symbol-->

            <!------------div 1-->


            <div class='container-fluid' id='all_mem_div'>
            <?php

            $query = "select * from family_details where emp_id = '$emp_id'";
            $res = @mysqli_query($conn,$query) or die("error in query ".$query);
            while($row = mysqli_fetch_array($res)){
              $fid = $row['fid'];

              echo("<div class='container-fluid' mem_id = '$fid' style = 'box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); padding:15px;'>
                <div class = 'row'>
                  <h3><span class='txt-blk'>&nbsp;&nbsp;&nbsp;</span></h3>
                    <div class = 'col-sm-6'>
                      <input type ='text' class = 'form-control txt-blk txt_mem_nm' name='Full name' placeholder='Full name' style = 'background : #fff;' value = '{$row['Full_name']}' disabled/><br />
                      <input type ='text' class = 'form-control txt-blk txt_mem_age' name='Age' placeholder='Age' style = 'background : #fff;' value = '{$row['Age']}' disabled/><br />
                    </div>
                    <div class = 'col-sm-6'>
                      <input type ='text' class = 'form-control txt-blk txt_mem_rlsn' name='Relationship' placeholder='Relationship' style = 'background : #fff;' value = '{$row['relationship']}' disabled/><br />");
                      /*echo("<select class='form-control txt-blk txt_mem_gender' name = 'gender' disabled>");


                        <option value = 'male'>Male</option>
                        <option value = 'female' selected>Female</option>
                        <option value = 'others'>Others</option>
                      echo("</select>
                      <br/>");*/
                    echo("</div>
                </div>
                <br />
                <div class='row'>
                    <div class='col-sm-6'>
                      <span class='txt-blk'><b>Id Proof</b></span>
                      <span href='#' data-toggle='tooltip' title='files must be in pdf format'>&nbsp;<i class='fa fa-info-circle'></i></span>
                      <br /><a href = 'uploads/{$row['Id_Proof']}' download class = 'txt_mem_id_dwnld'><i class='fa fa-download'></i> download</a>
                      <input type ='file' name='Id Proof' accept='application/pdf' class = 'form-control txt-blk disp-none txt_mem_id' style = 'background : #fff; font-size:12px; '/>
                    </div>
                    <div class='col-sm-6'>
                      <span class='txt-blk'><b>Medical Proof</b></span>
                      <span href='#' data-toggle='tooltip' title='files must be in pdf format'>&nbsp;<i class='fa fa-info-circle'></i></span>
                      <br /><a href = 'uploads/{$row['Medical_Proof']}' class = 'txt_mem_med_dwnld' download><i class='fa fa-download'></i> download</a>

                      <input type ='file' name='Medical Proof'  accept='application/pdf' class = 'form-control txt-blk disp-none txt_mem_med' style = 'background : #fff; font-size:12px;'/>
                    </div>
                </div>

                <div class='row'>
                  <br />
                  <div class='col-sm-3'>
                    
                  </div>
                    <div class ='col-sm-6'>
                        <center>
                        <a class='btn btn-success btn_mem_refresh disp-none'><i class='fa fa-refresh'></i></a>
                        <a class='btn btn-danger btn_mem_del' mem_del_id = '$fid'><i class='fa fa-trash'></i></a>
                        <a class='btn btn-success btn_mem_save disp-none' mem_save_id = '$fid'><i class='fa fa-save'></i></a>
                        <a class='btn btn-info btn_mem_edit' mem_edit_id = '$fid'><i class='fa fa-pencil'></i></a>

                        </center>
                    </div>
                  <div class='col-sm-3'>
                  </div>
                </div>
              </div>");
            }//end of while to display divs
            ?>  
            </div><!--end of all_div_mem-->

        </div>
        <div class = "col-sm-1">
        </div>
      </div>
    </div>
    <br /><br />        
  </body>
</html>



