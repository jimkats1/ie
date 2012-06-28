<?php
if(isset($_POST['profId']) && isset($_POST['courseId']))
{
	require_once(".inc/init.php");
	$profId = $_POST['profId'];
	$courseId = $_POST['courseId'];
	$profId = intval($profId);
	$courseId = intval($courseId);
	$sql = "INSERT INTO course_professor (cid, pid) VALUES ($courseId, $profId)";
	if(!mysql_query($sql))
	{
		die("DATABASE ERROR!");
	}
	$sql = "SELECT id, multiple_choice FROM question";
	if(!($result = mysql_query($sql)))
	{
		die("DATABASE ERROR!2");
	}
	while($row = mysql_fetch_assoc($result))
	{
		if($row['multiple_choice'] == 1)
		{
			$sql = "INSERT INTO result (cid,pid,qid) VALUES ($courseId, $profId, {$row['id']})";
			mysql_query($sql);
		}
	}
	echo "Ο Καθηγητής εισάχθηκε με επιτυχία!";
}
else
{
	die("Error 3!");
}
?>
