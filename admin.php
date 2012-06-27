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
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript">
			function conf()
			{
				var conf = confirm("Αυτή η ενέργεια είναι μη αναστρέψιμη. Είστε σίγουρος ότι θέλετε να συνεχίσετε?");
				if(conf === false)
				{
					document.getElementById("cleardb").href="admin.php?q=3";
					return false;
				}
				else
				{
					document.getElementById("cleardb").href="admin.php?q=3&cleardb=1";
					return true;
				}
			}
		</script>
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
						$sql = "DELETE question, result, textresult FROM (question LEFT JOIN result ON question.id=result.qid) LEFT JOIN textresult ON question.id=textresult.qid WHERE question.id='{$_GET['delete']}'";
						mysql_query($sql);
					}
					elseif(isset($_POST['submit']))
					{
						$_POST['new_q'] = stripslashes($_POST['new_q']);
						$mc = stripslashes($_POST['multiple_choice']);
						$_POST['new_q'] = mysql_real_escape_string($_POST['new_q']);
						$mc = mysql_real_escape_string($mc);
						$sql = "INSERT INTO question (name,multiple_choice) VALUES('{$_POST['new_q']}', '{$mc}')";
						mysql_query($sql);
						$sql = "SELECT MAX(id) FROM question";
						$maxId = mysql_query($sql);
						$maxId = mysql_fetch_assoc($maxId);
						$sql = "SELECT id FROM course";
						$courses = mysql_query($sql);
						while($row = mysql_fetch_assoc($courses))
						{
							$sql = "SELECT pid FROM course_professor WHERE cid='{$row['id']}'";
							$prof = mysql_query($sql);
							if($mc === 0)
							{
								while($row2 = mysql_fetch_assoc($prof))
								{
									$sql2 = "INSERT INTO result (cid,pid,qid) VALUES('{$row['id']}', '{$row2['pid']}', '{$maxId['MAX(id)']}')";
									mysql_query($sql2);
								}
							}
							else
							{
								while($row2 = mysql_fetch_assoc($prof))
								{
									$sql2 = "INSERT INTO textresult (cid,pid,qid) VALUES('{$row['id']}', '{$row2['pid']}', '{$maxId['MAX(id)']}')";
									mysql_query($sql2);
								}
							}
						}
					}
			?>
			<a href="admin.php"><input type="button" id="submit" value="&lt Επιστροφή" /></a>
			<form action="admin.php?q=1" method="post" onsubmit="return insertQCheck()">
				<table class="pointmeter">
					<tr><td>Εισαγωγή Ερώτησης: <input type="text" name="new_q" id="new_q" /></td><td>Πολλαπλής Επιλογής: Ναι<input type="radio" name="multiple_choice" id="multiple_choice" checked="checked" value="1"/> Όχι<input type="radio" name="multiple_choice" id="mulptiple_choice" value="0"/></td><td><input type="submit" name="submit" value="Εισαγωγή" /></td></tr>
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
				elseif(isset($_GET['q']) && $_GET['q'] == 2):
				if(isset($_GET['course']) && $_GET['course'] == 2)
				{
					$sql = "SELECT professor.id AS id, course_professor.id AS courseProf, professor.name, professor.surname, course.name AS course, sem_name FROM (course INNER JOIN semester ON course.semester=semester.id) INNER JOIN (course_professor INNER JOIN professor ON course_professor.pid=professor.id) ON course.id=course_professor.cid WHERE professor.id={$_GET['profId']}";
					$result = mysql_query($sql);
					echo "<table class='pointmeter'>";
					echo "<tr><th> Όνομα </th><th> Επώνυμο </th><th> Μάθημα </th><th> Εξάμηνο </th><th><br/></th></tr>";
					while($row = mysql_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['surname']."</td>";
						echo "<td>".$row['course']."</td>";
						echo "<td>".$row['sem_name']."</td>";
						echo "<td><a class='delete' href='admin.php?q=2&course=2&profId={$row['id']}&courseProf={$row['courseProf']}'>Αφαίρεση Μαθήματος από Καθηγητή</a></td></tr>";
						echo "</tr>";
					}
					echo "</table>";
				}
			?>
				<a href="admin.php"><input type="button" id="submit" value="&lt Επιστροφή" /></a>
				<form action="admin.php?q=2" method="post">
				<table class="pointmeter">
					<tr>
						<th colspan='2'>Εισαγωγή Καθηγητή</th>
					</tr>
					<tr>
						<td>Όνομα: </td><td><input type="text" name="profName"/></td>
					</tr>
						<td>Επώνυμο: </td><td><input type="text" name="profSurname"/></td>
					</tr>
					<tr>
						<td colspan='2'><input type="submit" name="insertProf" value="Εισαγωγή"/></td>
					</tr>
				</table>
				</form>
			<?php
						if(isset($_POST['insertProf']))
						{
							$profName = $_POST['profName'];
							$profSurname = $_POST['profSurname'];
							$sql = "INSERT INTO professor (name, surname) VALUES('$profName', '$profSurname')";
							mysql_query($sql); 
						}
						$sql = "SELECT professor.id, name, surname, COUNT(cid) FROM professor LEFT JOIN course_professor ON professor.id=course_professor.pid GROUP BY professor.id";
						$result = mysql_query($sql);
						echo "<table class='pointmeter'>";
						echo "<tr><th> Id </th><th> Όνομα </th><th> Επώνυμο </th><th> Πλήθος Μαθημάτων </th><th><br/></th></tr>";
						while($row = mysql_fetch_assoc($result))
						{
							echo "<tr>";
							echo "<td>".$row['id']."</td>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['surname']."</td>";
							echo "<td><a class='delete' href='admin.php?q=2&course=2&profId={$row['id']}'>".$row['COUNT(cid)']."</a></td>";
							echo "<td><a class='delete' href='admin.php?q=2&delete={$row['id']}'>Διαγραφή</a></td></tr>";
							echo "</tr>";
						}
						echo "</table>";
			?>
			<?php
				elseif(isset($_GET['q']) && $_GET['q'] == 3):
			?>
			<a href="admin.php"><input type="button" id="submit" value="&lt Επιστροφή" /></a><br/><br/><br/>
			<a href="admin.php?q=3&cleardb=1" id="cleardb"><input type="button" value="Διαγραφή όλων των Αποτελεσμάτων" onclick="conf()"/></a>
			<form action="admin.php?q=3" method="post">
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
									echo "<option value='".$row['sem_num']."'>{$row['sem_name']}</option>";
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
				<tr>
					<td colspan='2'>Εμφάνιση ερωτήσεων πολλαπλής επιλογής: </td>
					<td colspan='2'> Ναι<input type="radio" name="multiple_choice" id="multiple_choice" checked="checked" value="1"/> Όχι<input type="radio" name="multiple_choice" id="mulptiple_choice" value="0"/></td>
				</tr>
				<tr>
					<td colspan='4'><input type="submit" name="submit" value="Εμφάνιση"</td>
				</tr>
			</table>
			</form>
			<?php
				if(isset($_GET['cleardb']))
				{
					$sql = "UPDATE result SET ans1=0, ans2=0, ans3=0, ans4=0, ans5=0";
					mysql_query($sql);
					$sql = "TRUNCATE TABLE textresult";
					mysql_query($sql);
				}
			?>
			<?php
				if(isset($_POST['submit']))
				{
					if($_POST['multiple_choice']==1)
					{
						$sql = "SELECT name, ans1, ans2, ans3, ans4, ans5 FROM question INNER JOIN result ON question.id=result.qid WHERE cid={$_POST['course']} AND pid={$_POST['prof']}";
						$result = mysql_query($sql);
						echo "<table class='pointmeter'>";
						echo "<tr><th>Ερώτηση</th><th>Καθόλου - Απαράδεκτη</th><th>Λίγο - Μη ικανοποιητική</th><th>Μέτρια</th><th>Πολύ - Ικανοποιητική</th><th>Πάρα πολύ - Πολύ Καλή</th></tr>";
						while($row = mysql_fetch_array($result))
						{
							$all = $row['ans1'] + $row['ans2'] + $row['ans3'] + $row['ans4'] + $row['ans5'];
							$perc['ans1'] = ($row['ans1']/$all)*100;
							$perc['ans2'] = ($row['ans2']/$all)*100;
							$perc['ans3'] = ($row['ans3']/$all)*100;
							$perc['ans4'] = ($row['ans4']/$all)*100;
							$perc['ans5'] = ($row['ans5']/$all)*100;
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$perc['ans1']."&#37; (".$row['ans1'].")</td>";
							echo "<td>".$perc['ans2']."&#37; (".$row['ans2'].")</td>";
							echo "<td>".$perc['ans3']."&#37; (".$row['ans3'].")</td>";
							echo "<td>".$perc['ans4']."&#37; (".$row['ans4'].")</td>";
							echo "<td>".$perc['ans5']."&#37; (".$row['ans5'].")</td>";
							echo "</tr>";
						}
						echo "</table>";	
					}
					else
					{
						$sql = "SELECT name, textans FROM question INNER JOIN textresult ON question.id=textresult.qid WHERE cid={$_POST['course']} AND pid={$_POST['prof']}";
						$result = mysql_query($sql);
						echo "<table class='pointmeter'>";
						echo "<tr><th>Ερώτηση</th><th>Απάντηση</th></tr>";
						while($row = mysql_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['textans']."</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
				}
			?>
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
