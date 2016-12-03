<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// Update a student's year of sorting
if(!($stmt = $mysqli->prepare("UPDATE hw_students SET yearOfSorting = ? WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['YearSorting'],$_POST['StudentID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Updated " . $stmt->affected_rows . " student to hw_courses.";
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
	<title>Hogwarts Database: Student Updated</title>
</head>
<body>
	<p>Return to <a href="hw_students.php">Students</a> page.<br>
	<p>Return to <a href="hw_home.html">Main</a> page.</p>
</body>
<html>