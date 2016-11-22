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
	<title>Hogwarts Database: Courses</title>
</head>
<body>
	<h1>Courses</h1>
	
<div>
	<table>
		<tr>
			<td>Hogwarts Courses</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Courses</td>
		</tr>
		
<?php
if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, c.name FROM hw_people p INNER JOIN hw_students s ON p.id = s.id INNER JOIN hw_takes t ON s.id = t.studentID INNER JOIN hw_courses c ON c.id = t.courseID WHERE c.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['CourseID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $course)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $course . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>