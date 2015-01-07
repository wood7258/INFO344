<html>
	<head>
		<title>Get Even Numbers</title>
	</head>
	<body>
		<form>
			Define n:<br>
			<input type="text" name="n"><br>
			<input type="submit" value="Submit">
		</form>
		<br>
		<?php
			if(isset($_REQUEST["n"]))
			{
				$n = $_REQUEST["n"];
				for($i = 2; $i <= $n; $i+=2)
				{
					echo $i;
					echo " ";
				}
				echo "<br>";
				$p = 2;
				while($p <= $n)
				{
					echo $p;
					echo " ";
					$p = gmp_intval(gmp_nextprime($p));
				}
			}
		?>
	</body>
</html>
