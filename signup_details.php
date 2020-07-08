<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'db');
define('DB_USER','root');


$con=mysql_connect(DB_HOST,DB_USER) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$username=$_POST['username'];
$password=sha1($_POST['password']);
$address=$_POST['address'];
$mobileno=$_POST['mobileno'];
$usertype=$_POST['usertype'];
$emailid=$_POST['emailid'];

//$query=mysql_query("insert into user where username='".$username."' and password='".$password."'") or die(mysql_error());
//$res=mysql_fetch_row($query);
  
$query = "INSERT INTO user(usertype,username,address,mobileno,emailid,password)
values('$usertype','$username','$address','$mobileno','$emailid','$password')";
$result = mysql_query($query);

if($result)
{
  //session_start();
  //$_SESSION["login_user"]=$username;
  if($usertype=='P'){
		include "patient_loginpage.php";
	}
	else if($usertype=='D')
	{
		include "doctor_loginpage.php";
	}
	//else if($usertype=='A')
	//{
		//include "admin_loginpage.php";
	//}
  //echo'Welcome user ';
  //echo $_SESSION["login_user"];
       
}
else
{
	include "signup.php";
    echo 'Something went wrong!';
}

?>