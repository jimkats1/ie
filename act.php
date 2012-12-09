<?php
session_start();
if(empty($_SESSION['username']))
{
	$_SESSION['username']=$_POST['username'];
	$_SESSION['pass']=$_POST['pass'];
}
require_once(".inc/config.php");
require_once(".inc/ldap.php");
$user=$_SESSION['username'];
$pass=$_SESSION['pass'];
if($_SESSION['qform']===5)
{
	require_once(".inc/init.php");
	$cid = $_POST['course'];
	$pid = $_POST['prof'];
	$username = sha1($user);
	$username = mysql_real_escape_string($username);
	$cid = mysql_real_escape_string($cid);
	$pid = mysql_real_escape_string($pid);
	$query = mysql_query("SELECT username, cid FROM student WHERE username='$username' AND cid=$cid");
	$numrows = mysql_num_rows($query);
	$cid = intval($cid);
	$pid = intval($pid);
	if($numrows!=0)
	{
		$_SESSION['evalError']="Έχετε αξιολογήσει ήδη το συγκεκριμένο μάθημα!";
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'res.php';
		header("Location: http://$host$uri/$extra");
		die();
	}
	elseif(!is_int($cid) && !is_int($pid))
	{
		$_SESSION['evalError'] = "Γενικό Σφάλμα!";
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'res.php';
		header("Location: http://$host$uri/$extra");
		die();	
	}
	$query = mysql_query("SELECT * FROM question");
	while($row = mysql_fetch_array($query))
	{
		$qid = $row['id'];
		$ans = $_POST[$qid];
		$ans = mysql_real_escape_string($ans);
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
			$ans = trim($ans);
			if($ans!="" || $ans!=null)
			{
				mysql_query("INSERT INTO textresult (cid,pid,qid,textans) VALUES ('$cid','$pid','$qid','$ans')");
			}
		}
	}
	mysql_query("INSERT INTO student (username,cid) VALUES('$username','$cid')");
	$_SESSION['qform']=0;
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
elseif(($user==$testuser && $pass==$testpass) || ldapAuth($user,$pass))
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'questionnaire.php';
	header("Location: http://$host$uri/$extra");
}
else
{
	$_SESSION['evalError'] = "Γενικό Σφάλμα2!";	
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'res.php';
	header("Location: http://$host$uri/$extra");
}
?>
