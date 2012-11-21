<?php
	session_start();
	require_once(".inc/config.php");
	if(!isset($_SESSION['username']))
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<title>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</title>
	<script type="text/javascript" src="js/footer.js"></script>
</head>
<body>
	<div id="header">
  		<h1>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</h1>
  	</div>
  	<div id="main">
		<?php
			$error = $_SESSION['ldapError'];
			if(isset($_GET['error']))
			{
				echo "<h3 class='error'>Υπήρξε σφάλμα παρακαλώ επικοινωνήστε με τον Διαχειριστή: ". $adminmail ."</h3>\n";
				echo "<h4 class='error'>Τύπος σφάλματος: $error</h4>\n";
				echo "<a href='logout.php'><input type='button' id='submit' value='Επιστροφή' /></a>\n";
			}
			else
			{
				echo "<h3>Ευχαριστούμε για την Αξιολόγηση!</h3>\n";
				echo "<a href='logout.php'><input type='button' id='submit' value='Έξοδος' /></a>\n";
				echo "<a href='questionnaire.php'><input type='button' id='submit' value='Επιστροφή για αξιολόγηση άλλου μαθήματος' /></a>\n";
			}
		?>
	</div>
  	<div id="footer">
  		<script type="text/javascript">
			footer();
		</script>
  	</div>
</body>
</html>
