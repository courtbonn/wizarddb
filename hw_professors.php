<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cavenese-db","JnOBc71XAq0vwNhP","cavenese-db");
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
		width:100%;
		overflow:hidden;
	}
	</style>
	<title>Hogwarts Database: Professors</title>
</head>
<body>
	<h1>Professors</h1>

	<div id="left">
		<table>
			<tr>
				<th>Professors</th>
			</tr>
			<tr>
				<td>ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>House</td>
				<td>Wand</td>

			</tr>
			<?php
				if(!($stmt = $mysqli->prepare("SELECT pr.id, p.fname, p.lname, h.hname, p.wand FROM hw_professors pr INNER JOIN hw_people p ON pr.id = p.id INNER JOIN hw_house h ON p.house = h.id"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($prid, $fname, $lname, $house, $wand)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . $prid . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $house . "\n</td>\n<td>\n" . $wand . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
		</table>
	</div>

	<div>
		<form method="post" action="add_professor.php"> 
			<fieldset>
				<legend>Add a Professor</legend>
				<p>First Name: <input type="text" name="FirstName" /></p>
				<p>Last Name: <input type="text" name="LastName" /></p>
				<p><label>Wand:</label><br>
				Because only one person can possess a given wand, only wands that are not already possessed by another person are available.</p>
				<select name="Wand">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT w.id, w.length, w.flexibility, w.coretype, w.wandwood FROM hw_wand w WHERE w.id NOT IN (SELECT w.id FROM hw_wand w INNER JOIN hw_people p ON w.id = p.wand)"))){
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
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>

	<div>
		<form method="post" action="deleteprofessor.php"> 
			<fieldset>
				<legend>Delete a Professor</legend>
				<p><label>Professor:</label></p>
				<select name = "Delete_Professor">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT p.fname, p.lname, p.id FROM hw_professors pr INNER JOIN hw_people p ON p.id = pr.id"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($pfname, $plname, $pid)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value=" '. $pid . ' "> ' . $pfname . ' ' . $plname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>

</body>
</html>