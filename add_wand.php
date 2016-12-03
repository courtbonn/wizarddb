<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cavenese-db","JnOBc71XAq0vwNhP","cavenese-db");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
if(!($stmt = $mysqli->prepare("INSERT INTO hw_wand(length, flexibility, coretype, wandwood) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isss",$_POST['Length'],$_POST['Flexibility'],$_POST['CoreType'],$_POST['WandWood']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to hw_wand.";
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
	<title>Hogwarts Database: Wand Added</title>
</head>
<body>
	<p>Return to <a href="hw_wands.php">Wands</a> page.<br>
	<p>Return to <a href="hw_home.html">Main</a> page.</p>
</body>
<html>