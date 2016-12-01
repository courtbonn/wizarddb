<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}



// Update length of a wand
if(!($stmt = $mysqli->prepare("UPDATE hw_wand SET length = ?, flexibility = ?, coretype = ?, wandwood = ? WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isssi",$_POST['Length'],$_POST['Flexibility'],$_POST['CoreType'],$_POST['WandWood'],$_POST['WandID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Updated " . $stmt->affected_rows . " row to hw_wand.";
}
?>