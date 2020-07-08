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

?>

<!DOCTYPE html>
<html>
<head>
  <title>HT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- Important Owl stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
  
  <!-- Default Theme -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.css">

  <!-- Include js plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
  
  <link rel="stylesheet" href="bootstrap-3.3.5-dist\css\bootstrap.min.css">
  <script src="bootstrap-3.3.5-dist\css\bootstrap.min.js"></script>

  <link rel="stylesheet" href="style_home.css">
  <style>
  html,body {
	/* Workaround for some mobile browsers */
	height: 100%;
	background: linear-gradient(-30deg, #108C8C, #8EC2F9, #99F0F0, #D0FCFC, #E9FFFF, #FFFFFF); /* Standard syntax */
    max-width: 100%;
    overflow-x: hidden;
    overflow-y: hidden;
  }
  
  .navbar-default{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	margin-bottom: 0;
	z-index:1000;
	background-color: #20568F;
	border: 0;
	border-radius: 0;
  }
  
  .navbar-fixed-left {
  width: 170px;
  position: fixed;
  height: 100%;
  background-color: #20568F;
  border-radius: 0;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
 
  .navbar-fixed-left .navbar-nav > li {
  float: none;  /* Cancel default li float: left */
  width: 170px;
  }
 
  #s1{
  color: black;
  }
  
  div.transbox {
    background-color: lightgrey;
    width: 80%;
	height: 85%;
    padding: 5px;
    margin-top: 20px;
    margin-left: 190px;
	background-color: #ffffff;
	opacity: 0.9;
	filter: alpha(opacity=60); /* For IE8 and earlier */
	float: left;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  font {
	font-family: Candara;
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
	font-weight: 590;
	line-height: 20.9px;
  }
  
  .nav .active { background:#15385D }
  
  .button1:hover {
    box-shadow: 0px 0px 68px -4px #ABABAB;
  }
  
  .button1 {
	width: 160px;
	height: 50px
  }
  
  .navbar-fixed-left .navbar-nav li a:hover {
		background-color: #15385D;
		}
	h3{
		font-family: Candara;
		font-style: normal;
	}
  </style>
  </head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><font color="white">CDSS</font></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><font color="white"><br>
		<?php

                //$username = isset($_GET['username']) ? $_GET['username'] : "";
                
                echo'Welcome ';
                echo $_SESSION["login_user"];

        ?></font>
		</li>
        <li><a href="logout.php"><font color="white">Logout</font></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="navbar navbar-fixed-left">
  <ul class="nav navbar-nav">
   <li><a href="health_status.php"><font color="white">Health Status</font><br></a></li>
   <li><a href="myhistory.php"><font color="white">My History</font><br></a></li>
   <li class="active"><a href="hypertension_form.php"><font color="white">Check Hypertension</font><br></a></li>
   <li><a href="myreport.php"><font color="white">Generate my report</font><br></a></li>
  </ul>
</div>

<div class="transbox">
<div id="s1"><br>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fill the form below to check hypertension:</h3><div class="col-sm-offset-1"><a href="help_patient.php">Check here for help on values to be entered</a></div>
<br>
<div class="container">
	   <form name="htform" action="hypertension_formdetails.php" method="post">
         <div class="form-group">
            <label class="control-label col-sm-3" for="age"><font color="black">Age:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="age" name="age" placeholder="Enter age">
            </div>
          </div><br><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="height"><font color="black">Height:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="height" name="height" placeholder="Height in cms    e.g. 150 cms">
            </div>
          </div><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="weight"><font color="black">Weight:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="weight" name="weight" placeholder="Weight in kgs    e.g. 60 kgs">
            </div>
          </div><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="pulse"><font color="black">Pulse:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="pulse" name="pulse" placeholder="Pulse rate in beats per minute    e.g. 70 bps">
            </div>
          </div><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="cholesterol"><font color="black">Cholesterol:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="cholesterol" name="cholesterol" placeholder="Cholesterol in mg/dL    e.g. 190 mg/dL">
            </div>
          </div><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="smoke"><font color="black">Smoke:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="smoke" name="smoke" placeholder="Range from 0 to 3    e.g. 0">
            </div>
          </div><br><br>
          <div class="form-group">
            <label class="control-label col-sm-3" for="exercise"><font color="black">Exercise:</font></label>
            <div class="col-sm-4">          
              <input type="numeric" class="form-control" id="exercise" name="exercise" placeholder="Range from 0 to 3    e.g. 1">
            </div>
          </div><br><br><br>
          <div class="form-group">        
            <div class="col-sm-offset-2">
              <button type="submit" class="btn button1" style="background-color:#43BFC7;border:0;"><font color="white">Check hypertension</font></button>
            </div>
          </div>
        </form>
		
</div>
</div>
</div>

</body>
</html>