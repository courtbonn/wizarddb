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

<div>
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

<div>
	<form method="post" action="addperson.php"> 

		<fieldset>
			<legend>Add a Person</legend>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
			<p><label>Wand:</label></p>
			<select name="Wand">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, length, flexibility, coretype, wandwood FROM hw_wand"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $length, $flexibility, $coretype, $wandwood)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $length . "in, " . $flexibility . ", " . $coretype . ", " . $wandwood . '</option>\n';
}
$stmt->close();
?>
			</select>
		
		<p><label>House:</label></p>
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
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addwand.php"> 

		<fieldset>
			<legend>Add a Wand</legend>
			<p>Length: <input type="text" name="Length" /></p>
			<p>Flexibility: <input type="text" name="Flexibility" /></p>
			<p>Core Type: <input type="text" name="CoreType" /></p>
			<p>Wand Wood: <input type="text" name="WandWood" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="deletewand.php"> 

		<fieldset>
			<legend>Delete a Wand</legend>
			<p>Length: <input type="text" name="Length" /></p>
			<p>Flexibility: <input type="text" name="Flexibility" /></p>
			<p>Core Type: <input type="text" name="CoreType" /></p>
			<p>Wand Wood: <input type="text" name="WandWood" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

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