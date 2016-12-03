<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database

//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cavenese-db","JnOBc71XAq0vwNhP","cavenese-db");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// Delete person from hw_people	(will delete from hw_students ON CASCADE)
if(!($stmt = $mysqli->prepare("DELETE FROM hw_people WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("i",$_POST['Delete_Student']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Deleted " . $stmt->affected_rows . " rows from hw_students.";
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
	<title>Hogwarts Database: Student Deleted</title>
</head>
<body>
	<p>Return to <a href="hw_students.php">Students</a> page.<br>
	<p>Return to <a href="hw_home.html">Main</a> page.</p>
</body>
<html>