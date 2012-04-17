<?php
	require_once(".inc/init.php");
	if(empty($_GET['q']))
	{
		die("Error!!!");
	}
	$result = mysql_query("SELECT course.id, course.name FROM course INNER JOIN semester ON course.semester=semester.id WHERE course.semester={$_GET['q']}");
	echo "<option value='-1'></option>";
	while($row = mysql_fetch_array($result))
	{
		echo "<option value='".$row['id']."'>{$row['name']}</option>";
	}					
?>
