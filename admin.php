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
	$self=htmlentities($_SERVER['PHP_SELF']);
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
			<h2>Admin's Menu</h2>
			<table class="pointmeter">
				<tr><td>Questions<br/><a href="<?php echo $self . "?q=1"; ?>"><img src="images/surveys-icon.png" title="Questions" alt="Questions Icon" /></a></td><td>Prof and Courses<br/><a href="<?php echo $self . "?q=2"; ?>"><img src="images/Courses-icon.png" title="Professors and Courses" alt="Professors and Courses Icon" /></a></td></tr>
				<tr><td>Results<br/><a href="<?php echo $self . "?q=3"; ?>"><img src="images/folder-documents-icon.png" title="Results" alt="Result Icon" /></a></td><td>System Configuration<br/><a href="<?php echo $self . "?q=4"; ?>"><img src="images/Gear-icon.png" title="System Configuration" alt="Config Icon" /></a></td></tr>
			</table>
			<a href="logout.php"><input type="button" id="submit" value="Έξοδος" /></a>
		</div>
  		<div id="footer">
  			<script type="text/javascript">
				footer();
			</script>
  		</div>
	</body>
</html>
