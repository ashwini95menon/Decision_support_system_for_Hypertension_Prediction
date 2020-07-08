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
	height: 80%;
    padding: 25px;
    margin-top: 20px;
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
  
</style>
<script>

  function validateForm() 
  {
    var x1 = document.forms["signupform"]["username"].value;
    if (x1 == null || x1 == "") 
    {
       alert("Name must be filled out");

       return false;
    }

    var x2 = document.forms["signupform"]["emailid"].value;
    var n1=x2.indexOf("@");
    var n2=x2.indexOf(".");

    if(n1==-1 || n2==-1)
    {
      alert("mail_id Invalid");
      return false;
    }
    
    if(n2-n1==1)
    {  
      alert("mail_id Invalid");
      return false;
    }

    if(n1-0<1)
    {  
      alert("mail_id Invalid");
      return false;
    }

    var len=x2.length;
    if(len-n2<=1)
    {  
      alert("mail_id Invalid");
      return false;
    }

    var x3 = document.forms["signupform"]["password"].value;
	  var pass = /^[a-zA-Z0-9]+$/;  
	  if(!document.forms["signupform"]["password"].value.match(pass))  
	  {  
	    alert('Please input alphanumeric characters only');  
	   return false; 
	  }

    var x4 = document.forms["signupform"]["age"].value;
    if(x4<10 || x4>100)
    {  
      alert("age Invalid");
      return false;
    }
    

    var x5 = document.forms["signupform"]["mobileno"].value;
    var phoneno = /^\d{10}$/;  
    if(!x5.match(phoneno))    
      {  
        alert("phone invalid");  
        return false;  
      }  
  }
  
  </script>
</head>
<body>
<img src="background.jpg" id="bg">
<div class="transbox">
	
    <form role="form" name="signupform" onsubmit="return validateForm()" action="signup_details.php" method="post">
      <div class="row">
        <div class="form-group"><center>
          <label for="usertype"><font color="black">Select type of user:</font></label>
          <br>
          <label><div class="radio">
            <input type="radio" name="usertype" value="P">Patient &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div></label>
          <label><div class="radio">
            <input type="radio" name="usertype" value="D">Doctor
          </div></label>
          <!--<label><div class="radio">
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="usertype" value="A">Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div></label> -->
		  </center>
        </div>
      </div>
      <div class="row"> 
        <div class="col-xs-11">
          <div class="form-group">
            <label for="username"><font color="black">Name</font></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Name">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-11">
          <div class="form-group">
            <label for="age"><font color="black">Age</font></label>
            <input type="integer" class="form-control" id="age" name="age" placeholder="Enter age">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-11">
          <div class="form-group">
            <label for="address"><font color="black">Address</font></label>
            <textarea class="form-control" rows="4" id="address" name="address" placeholder="Enter Address"></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-11">
          <div class="form-group">
            <label for="mobileno"><font color="black">Mobile No</font></label>
            <input type="integer" class="form-control" id="mobileno" name="mobileno" placeholder="Enter Mobile No">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-11">
          <div class="form-group">
            <label for="emailid"><font color="black">Email-id</font></label>
            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter Email-id">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-11">
          <div class="form-group">
            <label for="password"><font color="black">Password</font></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
          </div>
        </div>
      </div>
      <center>
      <button type="submit" class="btn button1" style="background-color:#43BFC7;border:0;"><font color="white">Submit</font></button></center>
      <br><center><font color="black">If registered already? then</font> <a href="patient_loginpage.php"><font color="orange" weight="bold">Login</font></a></center>
    </form>

</div>

</body>
</html>

