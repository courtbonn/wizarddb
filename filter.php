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
<body>
<div>
	<table>
		<tr>
			<td>Hogwarts People</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Wand</td>
			<td>House</td>
		</tr>
		
<?php
if(!($stmt = $mysqli->prepare("SELECT hw_people.fname, hw_people.lname, hw_people.wand, hw_house.hname FROM hw_people INNER JOIN hw_house ON hw_people.house = hw_house.id WHERE hw_house.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['House']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $wand, $house)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $wand . "\n</td>\n<td>\n" . $house . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>