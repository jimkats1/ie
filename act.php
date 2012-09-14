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
if($_SESSION['qform']===5)
{
	require_once(".inc/init.php");
	$cid = $_POST['course'];
	$pid = $_POST['prof'];
	$query = mysql_query("SELECT * FROM question");
	while($row = mysql_fetch_array($query))
	{
		$qid = $row['id'];
		$ans = $_POST[$qid];
		if(!is_int($_POST['course']) && !is_int($_POST['prof']) && !is_int($_POST[$qid]))
		{
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'res.php?error';
			header("Location: http://$host$uri/$extra");
		}
		if($row['multiple_choice']==1)
		{
			switch ($ans)
			{
				case 1:
					mysql_query("UPDATE result SET ans1=ans1+1 WHERE cid=$cid AND pid=$pid AND qid=$qid");
					break;
				case 2:
					mysql_query("UPDATE result SET ans2=ans2+1 WHERE cid=$cid AND pid=$pid AND qid=$qid");
					break;
				case 3:
					mysql_query("UPDATE result SET ans3=ans3+1 WHERE cid=$cid AND pid=$pid AND qid=$qid");
					break;
				case 4:
					mysql_query("UPDATE result SET ans4=ans4+1 WHERE cid=$cid AND pid=$pid AND qid=$qid");
					break;
				case 5:
					mysql_query("UPDATE result SET ans5=ans5+1 WHERE cid=$cid AND pid=$pid AND qid=$qid");
					break;
			}
		}
		else
		{
			$ans = mysql_real_escape_string($ans);
			$ans = trim($ans);
			if($ans!="" || $ans!=null)
			{
				mysql_query("INSERT INTO textresult (cid,pid,qid,textans) VALUES ('$cid','$pid','$qid','$ans')");
			}
		}
	}
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'res.php';
	header("Location: http://$host$uri/$extra");
 }
 elseif($user==$adminuser && $pass==$adminpass)
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
