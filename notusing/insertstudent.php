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
	<form method="post" action="addstudent.php"> 

		<fieldset>
		<h1>ADD A STUDENT:</h1>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
			<p>Blood Status: <input type ="text" name ="BloodStatus" /></p>
			<p>Year of Sorting: <input type ="text" name="YearSorting" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>


	
	
	
</div>

</body>
</html>