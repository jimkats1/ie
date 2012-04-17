<?php
	session_start();
	require_once(".inc/init.php");
	require_once(".inc/config.php");
	if(!isset($_SESSION['username']))
	{
		session_destroy();
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri/");
	}
	elseif($_SESSION['username']!=$adminuser || $_SESSION['pass']!=$adminpass)
	{
		$host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'questionnaire.php';
                header("Location: http://$host$uri/$extra");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<title>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</title>
		<script type="text/javascript" src="js/questionnaire.js"></script>
		<script type="text/javascript" src="js/footer.js"></script>
	</head>
	<body>
		<div id="header">
  			<h1>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</h1>
  		</div>
  		<div id="main">
			<h2>THIS IS ADMIN'S AREA!</h2>
			<div>Πρόγραμμα Σπουδών</div>
			<div>Καθηγητές</div>
			<div>Ερωτηματολόγιο</div>
			<div>Ρυθμίσεις Συστήματος</div>
			<a href='logout.php'><input type='button' value='Έξοδος' /></a>
		</div>
  		<div id="footer">
  			<script type="text/javascript">
				footer();
			</script>
  		</div>
	</body>
</html>
