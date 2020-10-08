<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../image/logo.png',10,6,20);

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Free Pass',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function passTable($header, $data,$w)
{
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
function passengerTable($header, $data,$w)
{
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,$row[2],'LR');

        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

}
session_start();
if(!isset($_SESSION['emp_id']))
{
  header("location:user_login.php");
  exit();
}
$emp_id = $_SESSION['emp_id'];
require_once("../db_con.php");

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
/*for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);*/

$header = array('','');

//--------------------------------------------------------emp details--------------------------->
$pdf->Cell(0,10,'Employee details ',0,1);
$w = array(80,80);
$query = "select * from personal where emp_id = '$emp_id'";                
$res = @mysqli_query($conn,$query) or die("error in query ".$query);
$row = mysqli_fetch_assoc($res);
$data[0][0] = "ID";
$data[0][1] = $row["emp_unique_id"];

$data[1][0] = "Name";
$data[1][1] = $row["first_name"]." ".$row["last_name"];                   

$data[2][0] = "office";
$data[2][1] = $row["office_zone"];                   

$cid = $row["class_type_id"];
$data[3][0] = "class";

$query = "select * from class_type where class_type_id = '$cid'";                
$res = @mysqli_query($conn,$query) or die("error in query ".$query);
$row = mysqli_fetch_assoc($res);
$data[3][1] = $row["class_nm"];                   

$pid = $_GET["p"];

$query = "select * from passes where pass_id = '$pid'";              
$res = @mysqli_query($conn,$query) or die("error in query ".$query);
$row = mysqli_fetch_assoc($res);

$data[4][0] = "From";
$data[4][1] = $row['start_station'];
$data[5][0] = "To";
$data[5][1] = $row['dest_station'];
$data[6][0] = "Date";
$data[6][1] = $row['approval_date'];
$data[7][0] = "valid till";
$data[7][1] = date('Y-m-d',strtotime("+5 months",strtotime($row['approval_date'])));

if($row['half_full'] == '1')
	$txt = "one way";
else
	$txt = "round trip";
$data[8][0] = "one way/round trip";
$data[8][1] = $txt;

$ptypeid = $row['pass_type'];
$query1 = "select * from pass_type where pass_type_id = '$ptypeid'";                
$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
$row1 = mysqli_fetch_assoc($res1);
$data[9][0] = "pass type";
$data[9][1] = $row1['pass_type_nm'];
$pdf->passTable($header,$data,$w);
$pdf->LN();
$pdf->LN();

$pdf->LN();
$pdf->Cell(0,10,'Passengers details ',0,1);


						$header = array('Name','Age','Relation');
						$w1 = array(55,50,55);
						$c = 0;

					      	$query = "select * from pass_family where pass_id = '$pid'";              
		    				$res = @mysqli_query($conn,$query) or die("error in query ".$query);
		    				while($row = mysqli_fetch_assoc($res)){
		    					$fid = $row["family_id"];

		                      	if($fid != 0){
			                      	$query1 = "select * from family_details where fid = '$fid'";                
			    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
			    					$row1 = mysqli_fetch_assoc($res1);
			                      	$data1[$c][0] = $row1['Full_name'];
			                      	$data1[$c][1] = $row1['Age'];
			                      	$data1[$c][2] = $row1['relationship'];
		                      	}else{
		                      		$query1 = "select * from personal where emp_id = '$emp_id'";                
			    					$res1 = @mysqli_query($conn,$query1) or die("error in query ".$query1);
			    					$row1 = mysqli_fetch_assoc($res1);
			                      	$data1[$c][0] = $row1['first_name'];
			                      	$data1[$c][1] = $row1['age'];
			                      	$data1[$c][2] = "self";
		                      	}
		                      	$c++;
		                      	
		                    }


$pdf->passengerTable($header,$data1,$w1);

$pdf->Output();

?>