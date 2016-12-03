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
	<title>Hogwarts Database: Wands</title>
</head>
<body>
	<h1>Wands</h1>

	<div id="left">
		<table>
			<tr>
				<th>Wands</th>
			</tr>
			<tr>
				<td>ID</td>
				<td>Length</td>
				<td>Flexibility</td>
				<td>Core Type</td>
				<td>Wand Wood</td>
			</tr>
		
			<?php
			if(!($stmt = $mysqli->prepare("SELECT id, length, flexibility, coretype, wandwood FROM hw_wand"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($wid, $length, $flexibility, $coretype, $wandwood)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
			 echo "<tr>\n<td>\n" . $wid . "\n</td>\n<td>\n" . $length . "\n</td>\n<td>\n" . $flexibility . "\n</td>\n<td>\n" . $coretype . "\n</td>\n<td>\n" . $wandwood . "\n</td>\n</tr>";
			}
			$stmt->close();
			?>
		</table>
	</div>

	<div>
		<form method="post" action="add_wand.php"> 
			<fieldset>
				<legend>Add a Wand</legend>
				<p>Length: <input type="text" name="Length" /></p>
				<p>Flexibility: <input type="text" name="Flexibility" /></p>
				<p>Core Type: <input type="text" name="CoreType" /></p>
				<p>Wand Wood: <input type="text" name="WandWood" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>

	<div>
		<form method="post" action="deletewand.php"> 
			<fieldset>
				<legend>Delete a Wand</legend>
				<select name="Delete_Wand">
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
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>

	
</body>
</html>