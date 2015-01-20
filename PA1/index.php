<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Player Search</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<meta content="utf-8" http-equiv="encoding" />
        <link rel="stylesheet" href="lib/bootstrap-3.0.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="shortcut icon" href="img/logo.png">
	</head>
	<body>
		<?php
			function searchNames($name)
			{
				try {
					$conn = new PDO('mysql:host=wood7258.cjlh4ezw0x0v.us-west-2.rds.amazonaws.com;dbname=nba_stats', 'wood7258','in4matics');
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM Players WHERE UPPER(name) LIKE :fname OR UPPER(name) LIKE :lname ORDER BY name');
					$stmt->execute(array('fname' => $name.'%', 'lname' => '%'.$name));
					$results = array();
					$i = 0;
					while($row = $stmt->fetch()) {
						$results[$i] = $row;
						$i++;
					}
					return $results;
				} catch(PDOException $e) {
					echo 'ERROR: ' . $e->getMessage();
				}
			}
			
			function displayResults($results)
			{
				if(count($results)<1)
				{
					echo '<tr>';
					echo '<td colspan="6">No matches. Please try checking your spelling.</td>';
					echo '</tr>';
				} else {
					foreach($results as $result)
					{
						echo '<tr>';
						echo '<td>'.$result[1].'</td>';
						echo '<td>'.$result[2].'</td>';
						echo '<td>'.$result[3].'</td>';
						echo '<td>'.$result[4].'</td>';
						echo '<td>'.$result[5].'</td>';
						echo '<td>'.$result[6].'</td>';
						echo '</tr>';
					}
				}
			}
			
			function demandInput()
			{
				echo '<tr>';
				echo '<td colspan="6">Try searching a player\'s name to see his stats.</td>';
				echo '</tr>';
			}
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<img src="img/logotext.png" width="100%"/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form class="form-inline centered-form">
						<input type="text" name="pname" placeholder="Player name...">
						<input class="btn btn-default" type="submit" value="Submit">
					</form>
				</div>
			</div>
			<div class="row">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Player Name</th>
							<th>GP</th>
							<th>FGP</th>
							<th>TPP</th>
							<th>FTP</th>
							<th>PPG</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($_REQUEST["pname"]))
							{
								$name = strtoupper($_REQUEST["pname"]);
								$name = filter_var($name, FILTER_SANITIZE_STRING);
								if(strlen($name)>0)
								{
									$results = searchNames($name);
									displayResults($results);
								} else {
									demandInput();
								}
							} else {
								demandInput();
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
