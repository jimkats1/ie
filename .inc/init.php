<?php
	$db_server=""; //Server hosting the database
	$db_user=""; //Database User
	$db_pass=""; //Database Password
	$db="ie"; //Database name. If you change the name change it also here.

	$con=mysql_connect($db_server,$db_user,$db_pass);
	if(!$con)
	{
		die("Could not connect". mysql_error());
	}
	mysql_select_db($db,$con);
	mysql_query("SET NAMES utf8");
?>
