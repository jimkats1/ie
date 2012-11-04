<?php
 session_start();
 require_once(".inc/init.php");
 require_once(".inc/config.php");
 error_reporting(E_ALL & ~E_NOTICE);
if($_SESSION['username']==$adminuser && $_SESSION['pass']==$adminpass)
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<title>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</title>
		<script type="text/javascript" src="js/mcheck.js"></script>
		<script type="text/javascript" src="js/questionnaire.js"></script>
		<script type="text/javascript" src="js/footer.js"></script>
	</head>
	<body>
		<div id="header">
  			<h1>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</h1>
  		</div>
  		<div id="main">
  			<fieldset><legend>Σύνδεση</legend>
  				<form action="act.php" name="login" method="post" onsubmit="return check();">
  					<table>
						<tr>
  							<td class="leftCols"><label for="username">Όνομα χρήστη:</label></td>
  							<td class="rightCols"><input type="text" name="username" id="username"/></td>
  						</tr>
  						<tr>
  							<td class="leftCols"><label for="pass">Κωδικός πρόσβασης:</label></td>
  							<td class="rightCols"><input type="password" name="pass" id="pass"/></td>
  						</tr>
  					</table>
  					<input type="submit" value="Είσοδος" id="submit" />
  				</form> 
  			</fieldset>
  		</div>
  		<p class="error" id="error">Συμπληρώστε τα δυο παραπάνω πεδία για είσοδο!</p>
  		<?php
  			$sql = "SELECT * FROM config WHERE id='1'";
  			$result = mysql_query($sql);
  			$row = mysql_fetch_assoc($result);
  		?>
		<p class="warning"><?php echo $row['warning_message']; ?></p>
		<p class="intro"><?php echo $row['intro_message']; ?></p>
  		<div id="footer">
			<script type="text/javascript">
				footer();
			</script>
  		</div>
  		<?php
			if(isset($_GET['period']))
			{
				echo "<script type='text/javascript'>alert('ΔΕΝ ΕΙΝΑΙ ΠΕΡΙΟΔΟΣ ΑΞΙΟΛΟΓΗΣΗΣ!')</script>";
			}
		?>
	</body>
</html>
