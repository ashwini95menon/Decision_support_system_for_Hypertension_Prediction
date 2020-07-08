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
div.transbox {
    background-color: lightgrey;
    width: 450px;
	height: 550px;
    padding: 25px;
    margin-top: 60px;
    margin-right: 25px;
	background-color: #ffffff;
	opacity: 0.9;
	filter: alpha(opacity=60); /* For IE8 and earlier */
	float: right;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

  #bg {
  position: fixed; 
  top: 0; 
  left: 0; 
  
  /* Preserve aspet ratio */
  min-width: 100%;
  min-height: 100%;
  }

  .custom > li > a:hover {
  background-color: grey;
  }
  
  font {
	font-family: Candara;
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
	font-weight: 590;
	line-height: 20.9px;
  }
  
  input {
	font-family: Candara;
	font-size: 14px;
	font-style: normal;
	font-variant: normal;
	font-weight: 600;
	line-height: 20.9px;
  }
  
  #.s1 {
    box-shadow: 0px 0px 39px -8px #ABABAB;
  }
  
  .button1:hover {
    box-shadow: 0px 0px 68px -4px #ABABAB;
  }
  
  .button1 {
	width: 80px;
	height: 40px
  }
  
  #error{
	  font-family: Candara;
	  color: red;
	  font-size: 14px;
	  font-style: normal;
  }
  
</style>
</head>
<body>
<img src="background.jpg" id="bg">
<div class="transbox">
    <ul class="nav nav-tabs custom">
    <li><a href="patient_loginpage.php"><font color="black" weight="bold"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patient&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></a></li>
    <li><a href="doctor_loginpage.php"><font color="black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Doctor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></a></li>
    <li class="active"><a href="admin_loginpage.php"><font color="black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></a></li>
    </ul>
    <br><br><br><center><div id="error">Invalid username or password or usertype!</div></center><br><br>
    <form role="form" name="loginform" action="loginvalid.php" method="post">
      <div class="row">
        <div class="col-xs-10">
          <div class="form-group">
            <label for="username"><font color="black">Username</font></label>
            <div class="s1"><input type="text" class="form-control" id="username" name="username" placeholder="Enter username"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-10">
          <div class="form-group">
            <label for="password"><font color="black">Password</font></label>
            <div class="s1"><input type="password" class="form-control" id="password" name="password" placeholder="Enter password"></div>
          </div>
        </div>
      </div>
      <input type="hidden" name="usertype" id="usertype" value="P"><br><br>
      <center><button type="submit" class="btn button1" style="background-color:#43BFC7;border:0;"><font color="white">Login</font></button></center>
      <br><center>
      <font color="black">Are you a new user? then <a href="signup.php"><font color="orange" weight="bold">Signup</font></a></font></center>
    </form>
</div>

</body>
</html>

