<?php
session_start();
if(empty($_SESSION['username']))
{
	$_SESSION['username']=$_POST['username'];
	$_SESSION['pass']=$_POST['pass'];
}
require_once(".inc/config.php");
$user=$_SESSION['username'];
$pass=$_SESSION['pass'];
 if($user==$adminuser && $pass==$adminpass)
 {
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'admin.php';
	header("Location: http://$host$uri/$extra");
 }
elseif(isset($_SESSION['username']))
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'questionnaire.php';
	header("Location: http://$host$uri/$extra");

}
else
{
	$host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/");

}

?>
