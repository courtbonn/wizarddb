<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// Insert new person into hw_people	
if(!($stmt = $mysqli->prepare("INSERT INTO hw_people(fname, lname, house, wand) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssii",$_POST['FirstName'],$_POST['LastName'],$_POST['House'],$_POST['Wand']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
// Insert new professor into hw_professors that has the id of the person added to hw_people above
if(!($stmt = $mysqli->prepare("INSERT INTO hw_professors(id) VALUES ((SELECT p.id FROM hw_people p WHERE (p.fname = ? AND p.lname = ?)))"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['FirstName'],$_POST['LastName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Added " . $stmt->affected_rows . " rows to hw_professors.";
}
?>