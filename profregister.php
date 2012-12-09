<?php
session_start();
require_once(".inc/config.php");
if(!isset($_SESSION['username']))
	{
		die("ERROR: INVALID SESSION!");
	}
	elseif($_SESSION['username']!=$adminuser || $_SESSION['pass']!=$adminpass)
	{
		die("ERROR: YOU MUST BE ADMIN ACCOUNT!");
	}
if(isset($_POST['profId']) && isset($_POST['courseId']))
{
	require_once(".inc/init.php");
	$profId = $_POST['profId'];
	$courseId = $_POST['courseId'];
	$profId = intval($profId);
	$courseId = intval($courseId);
	$sql = "SELECT * FROM course_professor WHERE cid=$courseId AND pid=$profId";
	$result = mysql_query($sql);
	$result = mysql_num_rows($result);
	if($result!=0)
	{
		die("1Το συγκεκριμένο μάθημα περιέχει ήδη τον καθηγητή που επιλέξατε!");
	}
	$sql = "INSERT INTO course_professor (cid, pid) VALUES ($courseId, $profId)";
	if(!mysql_query($sql))
	{
		die("1ERROR: DATABASE ERROR!");
	}
	$sql = "SELECT id, multiple_choice FROM question";
	if(!($result = mysql_query($sql)))
	{
		die("1ERROR: DATABASE ERROR!2");
	}
	while($row = mysql_fetch_assoc($result))
	{
		if($row['multiple_choice'] == 1)
		{
			$sql = "INSERT INTO result (cid,pid,qid) VALUES ($courseId, $profId, {$row['id']})";
			mysql_query($sql);
		}
	}
	echo "Ο καθηγητής εισάχθηκε με επιτυχία!";
}
else
{
	die("1Error: Post arguments are not set!");
}
?>
