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
#$t=gettimeofday();

//inserting Record to the database
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$bmi=(($weight)/($height*$height));
$_SESSION["bmi_hyper"]=$bmi;
$height=(0.393701*$height);
$weight=(2.20462*$weight);
$pulse = $_POST['pulse'];
$cholesterol = $_POST['cholesterol'];
$smoke = $_POST['smoke'];
$_SESSION["smoke"]=$smoke;
$exercise = $_POST['exercise'];
$_SESSION["exercise"]=$exercise;

if($age=='' || $height=='' || $weight=='' || $pulse=='' || $cholesterol=='' || $smoke=='' || $exercise==''){
	if($utype=='D'){
		include "error_doc.php";
	}
	else if($utype=='P'){
		include "error_patient.php";
	}
	else if($utype=='A'){
		include "error_admin.php";
	}
}
else{
date_default_timezone_set("Asia/Kolkata");
$currentday = date('d');
$currentmonth = date('m');
$currentyear = date('Y');
$currenthour = date("H");
$currentminute = date("i");
$currentsecond = date("s");
$currentdate = date("Y:m:d");


$query = "INSERT INTO healthdetails(age,Transaction_Id,height,weight,waist,pulse,cholesterol,smoke,exercise,systolic,username,day,month,year,hour,minute,second,Date)
	values('$age',' ','$height','$weight',' ','$pulse','$cholesterol','$smoke','$exercise',' ','$uname','$currentday','$currentmonth','$currentyear','$currenthour','$currentminute','$currentsecond','$currentdate')";
$result1 = mysql_query($query);

exec('"C:\\Program Files\\R\\R-3.3.0\\bin\\Rscript" check_hypertension.R "'.$age.'" "'.$height.'" "'.$weight.'" "'.$pulse.'" "'.$cholesterol.'" "'.$smoke.'" "'.$exercise.'" "'.$uname.'" "'.$currentday.'" "'.$currentmonth.'" "'.$currentyear.'" "'.$currenthour.'" "'.$currentminute.'" "'.$currentsecond.'" "'.$currentdate.'" 2>&1', $output);

#exec('"C:\\Program Files\\R\\R-3.3.3\\bin\\Rscript" rcode.R "'.$age.'" "'.$weight.'" 2>&1', $output);

#print_r($output);

#echo ' ';
#echo $currentday;
#echo ' ';
#echo $currentmonth;
#echo ' ';
#echo $currentyear;
#echo ' ';
#echo $currenthour;
#echo ' ';
#echo $currentminute;
#echo ' ';
#echo $currentsecond;
#echo ' ';
#echo $currentDate;

if($result1)
	{
		$result2=mysql_query("select * from predictions where username='".$uname."' and day='".$currentday."' and month='".$currentmonth."' and year='".$currentyear."' and hour='".$currenthour."' and minute='".$currentminute."' and second='".$currentsecond."' ") or die(mysql_error());
		$row = mysql_fetch_array($result2);
		if($result2)
		{
		$_SESSION["sys"]=$row['sys'];
		$_SESSION["dias"]=$row['dias'];
		$_SESSION["predictions"]=$row['predictions'];
		if($utype=='D'){
			include "hypertension_predicted_doc.php";
		}
		else if($utype=='P'){
			include "hypertension_predicted.php";
		}
		else if($utype=='A'){
			include "hypertension_predicted_admin.php";
		}
		}
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
}
mysql_close($con);
?>