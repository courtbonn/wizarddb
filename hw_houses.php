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
	<title>Hogwarts Database: Houses</title>
</head>
<body>
	<h1>Houses</h1>

	<div id="left">
		<table>
			<tr>
				<th>Houses</th>
			</tr>
			<tr>
				<td>ID</td>
				<td>Name</td>
			</tr>
			<?php
				if(!($stmt = $mysqli->prepare("SELECT id, hname FROM hw_house"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($hid, $hname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . $hid . "\n</td>\n<td>\n" . $hname . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
		</table>
	</div>

	<div>
		<form method="post" action="add_house.php"> 
			<fieldset>
				<legend>Add a House</legend>
				<p>House Name: <input type="text" name="HouseName" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>

	<div>
		<form method="post" action="deletehouse.php"> 
			<fieldset>
				<legend>Delete a House</legend>
				<select name = "Delete_House">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, hname FROM hw_house"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($hid, $hname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo '<option value=" '. $hid . ' "> ' . $hname . '</option>\n';
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