<?php
	require_once(".inc/init.php");
	$course = intval($_GET['q']);
	if(empty($course) || !is_int($course))
	{
		die("Error!!!");
	}
	$result = mysql_query("SELECT professor.id, professor.name, professor.surname FROM professor INNER JOIN (course_professor INNER JOIN course ON course.id=course_professor.cid) ON professor.id=course_professor.pid WHERE course_professor.cid={$course}");
	echo "<option value='-1'></option>";
	while($row = mysql_fetch_array($result))
	{
		echo "<option value='".$row['id']."'>{$row['name']} {$row['surname']}</option>";
	}					
?>
