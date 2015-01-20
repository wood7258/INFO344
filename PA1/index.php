<html>
	<head>
		<title>Player Search</title>
	</head>
	<body>
		<form>
			<input type="text" name="pname" placeholder="Player name..."><br>
			<input type="submit" value="Submit">
		</form>
		<br />
		<?php
			if(isset($_REQUEST["pname"]))
			{
				$name = strtoupper($_REQUEST["pname"]);
				try {
					$conn = new PDO('mysql:host=wood7258.cjlh4ezw0x0v.us-west-2.rds.amazonaws.com;dbname=nba_stats', 'wood7258','in4matics');
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM Players WHERE UPPER(name) LIKE :fname OR UPPER(name) LIKE :lname');
					$stmt->execute(array('fname' => $name.'%', 'lname' => '%'.$name));
					while($row = $stmt->fetch()) {
						print_r($row);
					}
				} catch(PDOException $e) {
					echo 'ERROR: ' . $e->getMessage();
				}
			}
		?>
	</body>
</html>
