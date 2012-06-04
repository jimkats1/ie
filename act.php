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
		if($row['multiple_choice']==1)
		{
			switch ($ans)
			{
				case 1:
					mysql_query("INSERT INTO result (cid,pid,qid,ans1) VALUES ('$cid','$pid','$qid',1)");
					break;
				case 2:
					mysql_query("INSERT INTO result (cid,pid,qid,ans2) VALUES ('$cid','$pid','$qid',1)");
					break;
				case 3:
					mysql_query("INSERT INTO result (cid,pid,qid,ans3) VALUES ('$cid','$pid','$qid',1)");
					break;
				case 4:
					mysql_query("INSERT INTO result (cid,pid,qid,ans4) VALUES ('$cid','$pid','$qid',1)");
					break;
				case 5:
					mysql_query("INSERT INTO result (cid,pid,qid,ans5) VALUES ('$cid','$pid','$qid',1)");
					break;
			}
		}
		else
		{
			mysql_query("INSERT INTO result (cid,pid,qid,textans) VALUES ('$cid','$pid','$qid','$ans')");
		}
	}
		echo $pid . "everything ok?";
		/*$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");*/
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
