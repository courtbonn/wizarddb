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
	#right{
		clear:both;
	}
	</style>
</head>
<body>
<div id="left">
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
if(!($stmt = $mysqli->prepare("SELECT hw_people.fname, hw_people.lname, hw_people.wand, hw_house.hname FROM hw_people INNER JOIN hw_house ON hw_people.house = hw_house.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
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

<div id="left">
	<table>
		<tr>
			<td>Hogwarts Students</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>House</td>
			<td>Blood Status</td>
			<td>Year of Sorting</td>
			<td>Wand</td>
		</tr>
		
<?php
if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, h.hname, s.bloodStatus, s.yearOfSorting, p.wand FROM hw_students s INNER JOIN hw_people p ON p.id = s.id INNER JOIN hw_house h ON p.house = h.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $house, $bloodstatus, $yearofsorting, $wand)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $house . "\n</td>\n<td>\n" . $bloodstatus . "\n</td>\n<td>\n" . $yearofsorting . "\n</td>\n<td>\n" . $wand . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>
</p>
<div id="left">
	<table>
		<tr>
			<td>Hogwarts Professors</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>House</td>
			<td>Wand</td>
			<td>Head of House</td>
		</tr>
		
<?php
if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, h.hname, p.wand, pf.heads FROM hw_professors pf INNER JOIN hw_people p ON p.id = pf.id INNER JOIN hw_house h ON p.house = h.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $house, $wand, $head)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $house . "\n</td>\n<td>\n" . $wand . "\n</td>\n<td>\n" . $head . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>


<div id="right">
	<table>
		<tr>
			<td>Wands</td>
		</tr>
		<tr>
			<td>Wand ID</td>
			<td>Length</td>
			<td>Flexibility</td>
			<td>Core Type</td>
			<td>Wand Wood</td>
		</tr>
		
<?php
if(!($stmt = $mysqli->prepare("SELECT w.id, w.length, w.flexibility, w.coretype, w.wandwood FROM hw_wand w"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $length, $flexibility, $coretype, $wandwood)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $length . "in \n</td>\n<td>\n" . $flexibility . "\n</td>\n<td>\n" . $coretype . "\n</td>\n<td>\n" . $wandwood . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<a href="insertperson.php">Add a person</a></br>

<a href="insertstudent.php">Make a person a student</a></br>

<a href="insertwand.php">Add a wand</a></br>

<a href="delete-wand.php">Delete a wand</a></br>

<div>
	<form method="post" action="filter.php">
		<fieldset>
			<legend>Filter By House</legend>
				<select name="House">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, hname FROM hw_house"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $hname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $hname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>

</body>
</html>