<?php 
	include("header.php");
?>

	<div class="pizzad">
		<div class="banner">
				<img src="./images/banner.png">
		</div><!-- banner ends -->
	<div class="headline">
		<div class="headlines">Menüü</div>
	</div><!-- end headline -->
	<?php 
		error_reporting(-1);
		$mysqli = new mysqli("localhost", "test", "t3st3r123", "test");
		 
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		mysqli_set_charset($mysqli,"utf8");
		
		$query = "SELECT * FROM `sirle_menu` ORDER BY `id`;";
		
		if ($result = $mysqli->query($query)) {
		 
			print "<br><table border='1' width='940px'><tr><td><b></b></td><td><b>Pizza nimi</b></td><td><b>Pizzakate</b></td><td><b>Hind</b></td></tr>";
			/* fetch associative array */
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td><img src='".$row['image']."'></td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['toppings']."</td>";
				echo "<td>".$row['price']."</td></tr>";
			} 
			print "</table>";
			/* free result set */
			$result->free();
		}
		 
		/* close connection */
		$mysqli->close();
	?>
	</div>
<?php
	include("footer.php");
?>