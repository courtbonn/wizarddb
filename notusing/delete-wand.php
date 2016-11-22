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
	<style>
	#left{
		float:left;
		width:50%;
		overflow:hidden;
	}
	</style>
</head>
<body>
	
<div>
	<form method="post" action="deletewand.php"> 

		<fieldset>
			<h1>DELETE A WAND:</h1>
			<p>Wand ID: <input type="text" name="WandID" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

</body>
</html>