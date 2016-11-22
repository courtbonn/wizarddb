<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<style>
	#left{
		float:left;
		width:100%;
		overflow:hidden;
	}
	</style>
	<title>Hogwarts Database: Courses</title>
</head>
<body>
	<h1>Courses</h1>

	<div id="left">
		<table>
			<tr>
				<th>Courses</th>
			</tr>
			<tr>
				<td>Course Name</td>
				<td>Profesor First Name</td>
				<td>Professor Last Name</td>
			</tr>
			<?php
				if(!($stmt = $mysqli->prepare("SELECT c.name, p.fname, p.lname FROM hw_courses c LEFT JOIN hw_professors pr ON c.taughtby = pr.id LEFT JOIN hw_people p on pr.id = p.id"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($name, $fname, $lname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
		</table>
	</div>


	<div>
		<form method="post" action="addcourse.php"> 
			<fieldset>
				<legend>Add a Course</legend>
				<p>Course Name: <input type="text" name="CourseName" /></p>
				<p><label>Taught By:</label></p>
				<select name="TaughtBy">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, pr.id FROM hw_professors pr INNER JOIN hw_people p WHERE pr.id = p.id"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($fname, $lname, $prid)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value="' . $prid . '">' . $fname . " " . $lname . '</option>';
					}
					$stmt->close();
					?>
				</select>
			
			</fieldset>
			<p><input type="submit" /></p>
		</form>
	</div>

	<div>
		<form method="post" action="addstudentstocourse.php"> 
			<fieldset>
				<legend>Add Student to a Course</legend>
				<p><label>Select Student:</label></p>
				<select name="StudentID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, s.id FROM hw_students s INNER JOIN hw_people p WHERE s.id = p.id"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($fname, $lname, $sid)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value="' . $sid . '">' . $fname . " " . $lname . '</option>';
					}
					$stmt->close();
					?>
				</select>
				<p><label>Select Course:</label></p>
				<select name="CourseID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT c.id, c.name FROM hw_courses c"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($cid, $cname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value="' . $cid . '">' . $cname . '</option>';
					}
					$stmt->close();
					?>
				</select>
			
			</fieldset>
			<p><input type="submit" /></p>
		</form>
	</div>

	<div>
		<form method="post" action="querystudentsincourse.php"> 
			<fieldset>
				<legend>Display Students in a Course</legend>
			
				<p><label>Select Course:</label></p>
				<select name="CourseID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT c.id, c.name FROM hw_courses c"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($cid, $cname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value="' . $cid . '">' . $cname . '</option>';
					}
					$stmt->close();
					?>
				</select>
			
			</fieldset>
			<p><input type="submit" /></p>
		</form>
	</div>


</body>
</html>