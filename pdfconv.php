<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
set_time_limit(150);
//connecting to the database
if ((!defined('DB_HOST') && !defined('DB_NAME') && !defined('DB_USER') && !defined('DB_PASSWORD'))) {
define('DB_HOST', 'localhost');
define('DB_NAME', 'db');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysql_connect(DB_HOST,DB_USER) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

}

$uname = $_SESSION["login_user"];
$utype = $_SESSION["user_type"];

$uname = $_SESSION["login_user"];
date_default_timezone_set("Asia/Kolkata");
$currentdate = date("d:m:Y");
$currenttime = date("H:i:s");

require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->Cell(40,10,'Hypertension Report');
$pdf->Cell(190,10,'Date: '.$currentdate.'   '.$currenttime,'',1,'R');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'Hypertension Status Report',1,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->Cell(190,10,'Patient Name: '.$uname,1,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,10,'Date checked',1,0,'C');
$pdf->Cell(10,10,'Age',1,0,'C');
$pdf->Cell(14,10,'Height',1,0,'C');
$pdf->Cell(14,10,'Weight',1,0,'C');
$pdf->Cell(12,10,'Pulse',1,0,'C');
$pdf->Cell(20,10,'Cholesterol',1,0,'C');
$pdf->Cell(14,10,'Smoke',1,0,'C');
$pdf->Cell(16,10,'Exercise',1,0,'C');
$pdf->Cell(14,10,'Systolic',1,0,'C');
$pdf->Cell(16,10,'Diastolic',1,0,'C');
$pdf->Cell(35,10,'Risk',1,1,'C');
//$pdf->Write(5,'Visit ');

$result = mysql_query("SELECT age,height,weight,pulse,cholesterol,smoke,exercise,sys,dias,predictions,Date FROM predictions p  where p.username='$uname' ");
if (!$result) 
{
    die("Query to show fields from table failed");
}  

$result2 = mysql_query("select count(Transaction_Id) from predictions");

$fields_num = mysql_num_fields($result);
$array_age=Array();

while($row = mysql_fetch_array($result))
{
   $array_age[]= $row['age'];
   $array_height[]=$row['height'];
   $array_weight[]=$row['weight'];
   $array_pulse[]=$row['pulse'];
   $array_chol[]=$row['cholesterol'];
   $array_smoke[]=$row['smoke'];
   $array_exercise[]=$row['exercise'];
   $array_sys[]=$row['sys'];
   $array_dias[]=$row['dias'];
   $array_risk[]=$row['predictions'];
   $array_date[]=$row['Date'];
}  

//$i=6;
for($j=0;$j<sizeof($array_age);$j++) {
		  
$pdf->Cell(25,10,$array_date[$j],1,0,'C');
$pdf->Cell(10,10,$array_age[$j],1,0,'C');
$pdf->Cell(14,10,$array_height[$j],1,0,'C');
$pdf->Cell(14,10,$array_weight[$j],1,0,'C');
$pdf->Cell(12,10,$array_pulse[$j],1,0,'C');
$pdf->Cell(20,10,$array_chol[$j],1,0,'C');
$pdf->Cell(14,10,$array_smoke[$j],1,0,'C');
$pdf->Cell(16,10,$array_exercise[$j],1,0,'C');
$pdf->Cell(14,10,$array_sys[$j],1,0,'C');
$pdf->Cell(16,10,$array_dias[$j],1,0,'C');
$pdf->Cell(35,10,$array_risk[$j],1,1,'C');
//$i++;
}
					$ht = '';
					$wt = '';
					$sm = '';
					$ex = '';
                    $pr = '';
					$latest_bmi = '';	 
					$miti='';
					
$result = mysql_query("SELECT Date,Transaction_Id,age,height,weight,pulse,cholesterol,smoke,exercise,sys,dias,predictions FROM predictions WHERE Transaction_Id = ( SELECT MAX(Transaction_Id) maxTId FROM predictions) and username='".$uname."'");
        if (!$result) {
                die("Query to show fields from table failed");
        }  

        $fields_num = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result))
        {
					$ht = $row['height'];
					$ht= (2.54*$ht);
					$wt = $row['weight'];
					$wt = (0.453592*$wt);
					$sm = $row['smoke'];
					$ex = $row['exercise'];
                    $pr = $row['predictions'];
					$latest_bmi = (($wt)/($ht*$ht));
        }
		
			if($pr=='normal'){
				if($ex==0 and $latest_bmi>25){
					$miti = 'Exercise regularly to reduce weight and eat healthy food with low fats and sodium to prevent hypertension';
				}
				else if($sm==1 || $sm==2 || $sm==3){
					$miti = 'Stop smoking to prevent hypertension and eat healthy food with low fats and sodium to prevent hypertension';
				}
				else if($sm==1 and $ex==0 and $latest_bmi>25 || $sm==2 || $sm==3){
					$miti = 'Exercise regularly to reduce weight and stop smoking to prevent hypertension and eat healthy food with low fats and sodium to prevent hypertension';
				}
				else{
					$miti = 'Exercise regularly, avoid smoking and eat healthy food with low fats and sodium to prevent hypertension';
				}
			}
			else if($pr=='prehypertension'){
				if($ex==0 and $latest_bmi>25){
					$miti = 'Exercise regularly, avoid smoking and eat healthy food with low fats and sodium to decrease hypertension. Visit a doctor to check risk of cardiovascular or renal diseases. Take medication if necessary';
				}
				else if($sm==1 || $sm==2 || $sm==3){
					$miti = 'Stop smoking to prevent hypertension. Exercise regularly and eat healthy food with low fats and sodium to decrease hypertension. Visit a doctor to check risk of cardiovascular or renal diseases. Take medication if necessary';
				}
				else if($sm=1 and $ex==0 and $latest_bmi>25 || $sm==2 || $sm==3){
					$miti = 'Exercise regularly to reduce weight and stop smoking to prevent hypertension. Eat healthy food with low fats and sodium to decrease hypertension. Visit a doctor to check risk of cardiovascular or renal diseases. Take medication if necessary';
				}
				else{
					$miti = 'Exercise regularly, avoid smoking and eat healthy food with low fats and sodium to decrease hypertension. Visit a doctor to check risk of cardiovascular or renal diseases. Take medication if necessary';
				}
			}
			else if($pr=='Stage1'){
				if($ex==0 and $latest_bmi>25){
					$miti = 'Exercise regularly to reduce weight. Visit a doctor to keep hypertension under check. He may prescribe diuretics drug to lower blood pressure. Also check risk of cardiovascular or renal diseases.Consume low sodium food to further reduce the risk';
				}
				else if($sm==1 || $sm==2 || $sm==3){
					$miti = 'Stop smoking to prevent hypertension. Visit a doctor to keep hypertension under check. He may prescribe diuretics drug to lower blood pressure. Also check risk of cardiovascular or renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
				else if($sm==1 and $ex==0 and $latest_bmi>25 || $sm==2 || $sm==3){
					$miti = 'Exercise regularly to reduce weight and stop smoking to prevent hypertension. Visit a doctor to keep hypertension under check. He may prescribe diuretics drug to lower blood pressure. Also check risk of cardiovascular or renal diseases. Consume low sodium food to further reduce the risk';
				}
				else{
					$miti = 'Visit a doctor to keep hypertension under check. He may prescribe diuretics drug to lower blood pressure. Also check risk of cardiovascular or <br>renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
			}
			else if($pr=='Stage2'){
				if($ex==0 and $latest_bmi>25){
					$miti = 'Exercise regularly to reduce weight. Visit a doctor immediately to keep hypertension under check. He may prescribe a combination of hypertensive and diuretics drugs to lower blood pressure. Also check risk of cardiovascular or renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
				else if($sm==1 || $sm==2 || $sm==3){
					$miti = 'Stop smoking to prevent hypertension.Visit a doctor immediately to keep hypertension under check. He may prescribe a combination of hypertensive and diuretics drugs to lower blood pressure. Also check risk of cardiovascular or renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
				else if($sm==1 and $ex==0 and $latest_bmi>25 || $sm==2 || $sm==3){
					$miti = 'Exercise regularly to reduce weight and stop smoking to prevent hypertension. Visit a doctor immediately to keep hypertension under check. He may prescribe a combination of hypertensive and diuretics drugs to lower blood pressure. Also check risk of cardiovascular or renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
				else{
					$miti = 'Visit a doctor immediately to keep hypertension under check. He may prescribe a combination of hypertensive and diuretics drugs to lower blood pressure. Also check risk of cardiovascular or renal diseases. Exercise regularly and consume low sodium food to further reduce the risk';
				}
			}

$pdf->SetFont('Arial','',12);
$pdf->Cell(190,10,' ',0,1,'C');
$pdf->Write(5,'Based on your last health checkup you need to: '.$miti);
			
$pdf->Output();
?>


