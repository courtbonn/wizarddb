<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

$first = $_POST["FirstName"];
$last = $_POST["LastName"];	

	
if(!($stmt = $mysqli->prepare("INSERT INTO hw_students (id, bloodStatus, yearOfSorting) VALUES ((SELECT p.id FROM hw_people p WHERE p.fname = '$first' AND p.lname = '$last'), ?, ?")))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$id,$_POST['BloodStatus'],$_POST['YearSorting']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to hw_students.";
}
?>