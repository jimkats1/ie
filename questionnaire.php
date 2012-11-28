<?php
	session_start();
	require_once(".inc/init.php");
	require_once(".inc/config.php");
	$query = mysql_query("SELECT evaluation_period FROM config WHERE id='1'");
	$row = mysql_fetch_assoc($query);
	if(!isset($_SESSION['username']) || $row['evaluation_period'] == 0 || !isset($_SESSION['ldapSuccess']))
	{
		session_destroy();
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php?period=out';
		if($row['evaluation_period'] == 0) 
		{
			header("Location: http://$host$uri/$extra");
		}
		else
		{
			header("Location: http://$host$uri/");
		}
	}
	elseif($_SESSION['username']==$adminuser && $_SESSION['pass']==$adminpass)
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'admin.php';
		header("Location: http://$host$uri/$extra");
	}
	$_SESSION['qform']=5;
	$_SESSION['qresult']=0;
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
		<script type="text/javascript" src="js/ajax.js"></script>
	</head>
	<body>
		<div id="header">
  			<h1>ΕΣΩΤΕΡΙΚΗ ΑΞΙΟΛΟΓΗΣΗ ΤΕΣΥΔ</h1>
  		</div>
  		<div id="main">
			<a href="logout.php"><input type="button" id="submit" value="Έξοδος" /></a><br/>
			<form name="questionnaire" action='act.php' method='post' onsubmit="return formCheck()">
			<h5>(*)Ολα τα πεδία είναι υποχρεωτικά</h5>	
			<table class="pointmeter">
				<tr>
					<td colspan='2'>Επέλεξε το εξάμηνο του μαθήματος: </td>
					<td colspan='2'>
						<select name="semester" id="semester" onchange="semesterSelected()">
							<option value='-1'></option>
							<?php
								$result = mysql_query("SELECT * FROM semester");
								while($row = mysql_fetch_array($result))
								{
									echo "<option value='".$row['id']."'>{$row['sem_name']}</option>";
								}	
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td> Επέλεξε Μάθημα: </td>
					<td>
						<select name="course" id="course" onchange="courseSelected()">
							<option value='-1'></option>
						</select>
					</td>
					<td> Επέλεξε Καθηγητή: </td>
					<td>
						<select name="prof" id="prof">
							<option value='-1'></option>
						</select>
					</td>
				</tr>
			</table>
  			<table class="pointmeter">
				<tr>
					<th colspan='5'>Βαθμολογική Κλίμακα</th>
				</tr>
				<tr>
					<td>Καθόλου</td>
					<td>Λίγο</td>
					<td>Μέτρια</td>
					<td>Πολύ</td>
					<td>Πάρα Πολύ</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
				</tr>
				<tr>
					<td>Απαράδεκτη</td>
					<td>Μη ικανοποιητική</td>
					<td>Μέτρια</td>
					<td>Ικανοποιητική</td>
					<td>Πολύ Καλή</td>
				</tr>
			</table>
			<table class="questionnaire">
				<?php
					$result = mysql_query("SELECT * FROM question");
					while($row = mysql_fetch_array($result))
  					{
						if($row['multiple_choice']==1)
                        {
							echo "<tr><td class='leftCols'>";
							echo $row['name'];
                            echo "</td><td>";
                            echo "<select name=".$row['id']." class='question'><option value='empty'></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
                        }
                        else
                        {
							echo "<tr><td class='leftCols' colspan='2'>";
							echo "<span>".$row['name']."</span>";
                            echo "<textarea name=".$row['id']." class='textquestion'></textarea>";
                        }
						echo "</td></tr>";
  					}
				?>
			</table>
			<input type='submit' id='submit' name='submit' value='Υποβολή' />
			</form>
  		</div>
  		<div id="footer">
  			<script type="text/javascript">
				footer();
			</script>
  		</div>
	</body>
</html>
