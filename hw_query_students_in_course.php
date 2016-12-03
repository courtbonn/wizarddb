<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cavenese-db","JnOBc71XAq0vwNhP","cavenese-db");
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
	<title>Hogwarts Database: Students in Course Query</title>
</head>
<body>
	<h1>Students in 
		<?php
				if(!($stmt = $mysqli->prepare("SELECT c.name FROM hw_courses c WHERE c.id = ?"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!($stmt->bind_param("i",$_POST['CourseID']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
				} 
				if(!$stmt->bind_result($cname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo $cname;
				}
				$stmt->close();
		?>
	</h1>

	<div id="left">
		<table>
			<tr>
				<td>Student First Name</td>
				<td>Student Last Name</td>
			</tr>
			<?php
				if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname
					FROM hw_students s
					INNER JOIN hw_people p ON p.id = s.id
					WHERE s.id IN
					(
					SELECT s.id
					FROM hw_students s
					INNER  JOIN hw_takes tk ON s.id = tk.studentID
					INNER  JOIN hw_courses c ON tk.courseID = c.id
					WHERE c.id =  ?)"
					))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}
				if(!($stmt->bind_param("i",$_POST['CourseID']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($fname, $lname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
		</table>
	</div>
	<br>
	<br>
	<p>Return to <a href="hw_courses.php">Courses</a> page.<br>
	<p>Return to <a href="hw_home.html">Main</a> page.</p>

</body>
</html>