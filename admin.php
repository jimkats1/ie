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
		<script type="text/javascript" src="js/mcheck.js"></script>
		<script type="text/javascript" src="js/footer.js"></script>
	</head>
	<body>
		<div id="header">
  			<h1>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</h1>
  		</div>
  		<div id="main">
			<?php
				if(isset($_GET['q']) && $_GET['q'] == 1):
					if(isset($_GET['delete']))
					{
						$sql = "DELETE FROM question WHERE id='{$_GET['delete']}'";
						mysql_query($sql);
					}
					elseif(isset($_POST['submit']))
					{
						$_POST['new_q'] = stripslashes($_POST['new_q']);
						$_POST['multiple_choice'] = stripslashes($_POST['multiple_choice']);
						$_POST['new_q'] = mysql_real_escape_string($_POST['new_q']);
						$_POST['multiple_choice'] = mysql_real_escape_string($_POST['multiple_choice']);
						$sql = "INSERT INTO question (name,multiple_choice) VALUES('{$_POST['new_q']}', '{$_POST['multiple_choice']}')";
						mysql_query($sql);
					}
			?>
			<a href="admin.php"><input type="button" id="submit" value="&lt Επιστροφή" /></a>
			<form action="admin.php?q=1" method="post" onsubmit="return insertQCheck()">
				<table class="pointmeter">
					<tr><td>Εισαγωγή Ερώτησης: <input type="text" name="new_q" id="new_q" /></td><td>Πολλαπλής Επιλογής: Ναι<input type="radio" name="multiple_choice" id="multiple_choice" value="1"/> Όχι<input type="radio" name="multiple_choice" id="mulptiple_choice" value="0"/></td><td><input type="submit" name="submit" value="Εισαγωγή" /></td></tr>
				</table>
			</form>	
			<table class="questionnaire">
				<tr>
					<th>Id</th>
					<th>Ερώτηση</th>
					<th>Πολλαπλής Επιλογής</th>
					<th><br/></th>
				</tr>
				<?php
					$sql = "SELECT * FROM question";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result))
					{
						echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td>";
						if($row['multiple_choice']==1)
						{
							echo "<td>ΝΑΙ</td>";
						}
						else
						{
							echo "<td>ΟΧΙ</td>";
						}
						echo "<td><a class='delete' href='admin.php?q=1&delete={$row['id']}'>Διαγραφή</a></td></tr>";
					}
				?>
			</table>
			<?php
				elseif(isset($_GET['q']) && $_GET['q'] == 4):
					if(isset($_POST['submit']))
					{
						$sql = "UPDATE config SET warning_message='{$_POST['warning_message']}',intro_message='{$_POST['intro_message']}',evaluation_period='{$_POST['eval_period']}' WHERE id='1'";
						if(mysql_query($sql))
						{
							echo "<script type='text/javascript'>alert('Οι αλλαγές αποθηκεύτηκαν!')</script>";
						}
						else
						{
							echo "<script type='text/javascript'>alert('Σφάλμα!')</script>";
						}
					}
					$sql = "SELECT * FROM config WHERE id='1'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
			?>
				<a href="admin.php"><input type="button" id="submit" value="&lt Επιστροφή" /></a>
				<form name="system_config" action="admin.php?q=4&submit=1" method="post">
					<table class='pointmeter'>
						<tr><td><label for='warning_message'>Warning Message: </label></td><td><textarea name='warning_message'><?php echo $row['warning_message']; ?></textarea></td></tr>
						<tr><td><label for='intro_message'>Intro Message: </label></td><td><textarea name='intro_message'><?php echo $row['intro_message']; ?></textarea></td></tr>
						<tr><td><label for='evaluation_period'>Περίοδος Αξιολόγησης: </label></td>
							<?php
								if($row['evaluation_period'] == 1)
								{
									echo "<td>Ναι<input type='radio' name='eval_period' value='1' checked='checked' /> Όχι<input type='radio' name='eval_period' value='0' /></td></tr>";
									
								}
								else
								{
									echo "<td>Ναι<input type='radio' name='eval_period' value='1' /> Όχι<input type='radio' name='eval_period' value='0' checked='checked' /></td></tr>";
								}
							?>	
						<tr><td colspan='2'><input type='submit' name='submit' value='Αποθήκευση' /></td></tr>
					</table>
				</form>
			<?php
				else:
			?>
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
<?php
endif;
?>
