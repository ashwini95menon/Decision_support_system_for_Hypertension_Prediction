<?php     
    session_start();
    unset($_SESSION['login_user']);  

	//$_SESSION["login_user"]="xyz";
    session_destroy();
	//$_SESSION = array();
    header('location:patient_loginpage.php');
    exit();
    header("Cache-Control", "no-cache, no-store, must-revalidate");
?>