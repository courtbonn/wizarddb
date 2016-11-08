<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonnc-db","q60oUq13cpkrUQE7","bonnc-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
<!--$length = $_POST['Length'];
$flexibility = $_POST['Flexibility'];
$coretype = $_POST['CoreType'];
$wandwood = $_POST['WandWood'];
!-->	
	
	
$mysqli = "DELETE FROM hw_wand WHERE length = $length AND flexibility = $flexibility AND coretype = $coretype AND wandwood = $wandwood";

?>