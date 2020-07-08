<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'db');
define('DB_USER','root');

$con=mysql_connect(DB_HOST,DB_USER) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$username=$_POST['username'];
$password=sha1($_POST['password']);
$usertype=$_POST['usertype'];

  $query=mysql_query("select * from user where username='".$username."' and password='".$password."' and usertype='".$usertype."'") or die(mysql_error());
  $res=mysql_fetch_row($query);
  if($res)
  {
    session_start();
    $_SESSION["login_user"]=$username;
	$_SESSION["user_type"]=$usertype;
	if($usertype=='P'){
		include "health_status.php";
	}
	else if($usertype=='D')
	{
		include "history_doc.php";
	}
	else if($usertype=='A')
	{
		include "history_admin.php";
	}
    //echo'Welcome user ';
    //echo $_SESSION["login_user"];
  }
  else
  {
    if($usertype=='D'){
		include "error_loginpage_doc.php";
	}
	else if($usertype=='P'){
		include "error_loginpage_patient.php";
	}
	else if($usertype=='A'){
		include "error_loginpage_admin.php";
	}
  }


?>