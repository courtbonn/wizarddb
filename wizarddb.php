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
	<title>Hogwarts Database: Welcome!</title>
</head>
<body>

<h1>Hogwarts Database</h1>

	<p>Welcome to the Hogwarts database! Click the links below to access, add, and update information about Hogwarts.</p>

	<ul>
		<li><a href="professors.php">Professors</a></li>
		<li><a href="students.php">Students</a></li>
		<li><a href="houses.php">Houses</a></li>
		<li><a href="wands.php">Wands</a></li>
		<li><a href="courses.php">Courses</a></li>
	</ul>

</p>

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