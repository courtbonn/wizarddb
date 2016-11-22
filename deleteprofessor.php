<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// Delete person from hw_people	(will delete from hw_professors ON CASCADE)
if(!($stmt = $mysqli->prepare("DELETE FROM hw_people WHERE fname = ? AND lname = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['FirstName'],$_POST['LastName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Deleted " . $stmt->affected_rows . " rows from hw_professors.";
}
?>