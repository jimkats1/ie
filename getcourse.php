<?php
	require_once(".inc/init.php");
	$course = intval($_GET['q']);
	if(empty($course) || !is_int($course))
	{
		die("Error!!!");
	}
	$result = mysql_query("SELECT course.id, course.name FROM course INNER JOIN semester ON course.semester=semester.id WHERE course.semester={$course}");
	echo "<option value='-1'></option>";
	while($row = mysql_fetch_array($result))
	{
		echo "<option value='".$row['id']."'>{$row['name']}</option>";
	}					
?>
