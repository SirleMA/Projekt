<?php 
	include($_SERVER["DOCUMENT_ROOT"] . "/Projekt/header.php");
?>
<div class="sisesta">
	<div class="text">
		<p> Restorani sisestamiseks täida allolevad väljad ja vajuta "Salvesta". Sisestatud välja näed allosas.
		<p> Tagasi minemiseks esilehele, vajuta <a href="./secure.php">siia.</a>
	</div>
	<form name="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		Restorani nimi: <input pattern=".{3,30}" type="text" name="name" required title="minimum 3 tähemärki"/>
		Aadress: <input pattern=".{5,100}" type="text" name="address" title="minimum 5 tähemärki"/>
		<input type="submit" name="rsubmit" value="Salvesta"/>
		<?php
			if (isset($_POST['rsubmit'])){
				$host = 'localhost';
				$username = 'root';
				$pass = 'root';
				$db = 'pitsa';
				$mydb = mysql_connect($host,$username,$pass);
				mysql_select_db($db);
				mysql_set_charset('utf8');
				
				$rname = $_POST['name'];
				$raddress = $_POST['address'];
				
				$query = "INSERT INTO `restoran`(`id`, `name`, `address`) VALUES ('','$rname','$raddress')";
				$result = mysql_query($query);
					echo '<script>';
					echo 'setTimeout(function() { alert("Restoran on edukalt lisatud!"); }, 0);';
					echo '</script>';
			}
			
			?>
	</form>
</div>
<hr>
<div class="vaata">
	<div class="sisestatud">
		<p><b>Siia kuvatakse kõik hetkel sisestatud restoranid nime ja aadressi kaupa.</b>
	</div>
		<?php 
		error_reporting(-1);
		$mysqli = new mysqli("localhost", "root", "root", "pitsa");
		 
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		mysqli_set_charset($mysqli,"utf8");

		$query = "SELECT * FROM  `restoran` ORDER BY  `id`;";
		
				if ($result = $mysqli->query($query)) {
		 
			
			/* fetch associative array */
			while ($row = $result->fetch_assoc()) {
				echo "Nimi: ".$row['name']."<br>Aadress: ".$row['address']."<br><br>";
			} 
			/* free result set */
			$result->free();
		}
		 
		/* close connection */
		$mysqli->close();
	?>
</div>