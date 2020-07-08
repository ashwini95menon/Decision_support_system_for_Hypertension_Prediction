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
  
   table {
            margin: auto;
            font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
            font-size: 12px;
        }
 
        table td {
            transition: all .5s;
        }
         
        /* Table */
        .data-table {
            border-collapse: collapse;
            font-size: 14px;
            min-width: 537px;
        }
 
        .data-table th, 
        .data-table td {
            border: 1px solid #e1edff;
            padding: 7px 17px;
        }
        .data-table caption {
            margin: 7px;
        }
 
        /* Table Header */
        .data-table thead th {
            background-color: #508abb;
            color: #FFFFFF;
            border-color: #6ea1cc !important;
            text-transform: uppercase;
        }
 
        /* Table Body */
        .data-table tbody td {
            color: #353535;
        }
        .data-table tbody td:first-child,
        .data-table tbody td:nth-child(4),
        .data-table tbody td:last-child {
            text-align: right;
        }
 
        .data-table tbody tr:nth-child(odd) td {
            background-color: #f4fbff;
        }
        .data-table tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
        }
 
        /* Table Footer */
        .data-table tfoot th {
            background-color: #e5f5ff;
            text-align: right;
        }
        .data-table tfoot th:first-child {
            text-align: left;
        }
        .data-table tbody td:empty
        {
            background-color: #ffcccc;
        }
		h4{
		font-family: Candara;
		font-style: normal;
		}
  
</style>
</head>
<body>

<table class="data-table"><br>
        <thead>
            <tr>
                <th>Username</th>
				<th>Systolic</th>
                <th>Diastolic</th>
                <th>Predictions</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
<center>
<?php
$q = strval($_GET['q']);
echo '<h4>History of ';
echo $q.'</h4><br>';

define('DB_HOST', 'localhost');
define('DB_NAME', 'db');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysql_connect(DB_HOST,DB_USER) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL db: " . mysql_error());

$sql="SELECT * FROM predictions p WHERE p.username = '".$q."'";
$result = mysql_query($sql,$con) or die("Failed to connect to MySQL query: " . mysql_error());

while($row = mysql_fetch_array($result)) {
    echo "<tr>";
	echo "<td>&nbsp;" . $row['username'] . "&nbsp;</td>";
    echo "<td>&nbsp;" . $row['sys'] . "&nbsp;</td>";
    echo "<td>&nbsp;" . $row['dias'] . "&nbsp;</td>";
    echo "<td>&nbsp;" . $row['predictions'] . "&nbsp;</td>";
    echo "<td>&nbsp;" . $row['Date'] . "</td>";
    echo "</tr>";
}
mysql_close($con);
?>
</center>
        </tbody>
    </table>
</body>
</html>