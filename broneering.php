<?php 
	include("header.php");
?>

<div class="broneeringuvorm">
		<div class="text">
			<p> Broneeringu tegemiseks täida allolevad väljad ja vajuta "Salvesta". Tehtud broneeringud kuvatakse allosas.
			<p> Tagasi minemiseks esilehele, vajuta <a href="./secure.php">siia.</a>
		</div>
	
	<form name="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		Restorani nimi: <select name="bname">
			<?php 
				$host = 'localhost';
				$username = 'test';
				$pass = 't3st3r123';
				$db = 'test';
				$mydb = mysql_connect($host,$username,$pass);
				mysql_select_db($db);
				mysql_set_charset('utf8');
				$sql = mysql_query("SELECT * FROM sirle_restoran");
				while ($row = mysql_fetch_array($sql)){
					unset($id, $name);
					$id = $row['id'];
					$name = $row['name']; 
					echo '<option value="'.$id.'">'.$name.'</option>';
				}				
			?>
		</select>
		Broneeringu kuupäev: <input type="date" name="bdate"/>
		Algusaeg: <input type="time" name="barrive"/>
		Kestvus: <input type="number" min="0" step="0.1" name="blength"/>
		Inimeste arv: <input type="number" min="1" max="50" step="1" name="bnumber"/>
		Kontakt isik: <input pattern=".{2,50}" type="text" name="brname"/>
		Broneering: <select name="bron">
			<?php 
				$sql = mysql_query("SELECT * FROM sirle_kanal");
				while ($row = mysql_fetch_array($sql)){
					unset($id, $bron);
					$id = $row['id'];
					$bron = $row['bron']; 
					echo '<option value="'.$id.'">'.$bron.'</option>';
				}				
			?>
		</select>
		Kontakt number: <input pattern=".{5,10}" type="text" name="btel"/>
		Kommentaar: <input type="text" name="bcom" maxlength="500" height="200px"/>
		<input type="submit" name="rsubmit" value="Salvesta"/>
				<?php
			
			if (!empty($_POST['rsubmit'])) {
				error_reporting(E_ALL ^ E_STRICT);
		
			if(empty($_POST['bname'])){
				echo '<script>';
				echo 'alert("Restorani nimi on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['bdate'])){
				echo '<script>';
				echo 'alert("Kuupäev on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['barrive'])){
				echo '<script>';
				echo 'alert("Algusaeg on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['blength'])){
				echo '<script>';
				echo 'alert("Kestvus on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['bnumber'])){
				echo '<script>';
				echo 'alert("Inimeste arv on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['brname'])){
				echo '<script>';
				echo 'alert("Kontaktisiku nimi on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['bron'])){
				echo '<script>';
				echo 'alert("Broneering on kohustuslik väli!");';
				echo '</script>';
			} else {
				$bname = $_POST['bname']; 
				$bdate = $_POST['bdate'];
				$barrive = $_POST['barrive'];
				$blength = $_POST['blength'];
				$bnumber = $_POST['bnumber'];
				$brname = $_POST['brname'];
				$bron = $_POST['bron'];
				$tel = $_POST['btel'];
				$comment = $_POST['bcom'];
				
			$query = mysql_query("INSERT INTO `sirle_broneering`(`id`, `rid`, `date`, `time`, `duration`, `number`, `contact`, `kid`, `tel`, `comments`, `bdate`) VALUES ('','$bname','$bdate','$barrive','$blength','$bnumber','$brname','$bron','$tel','$comment',NOW())")or die(mysql_error());
			$result = mysql_query($query);
				echo '<script>';
				echo 'alert("Broneering on edukalt sisestatud!");';
				echo '</script>';
				}
			}
		?>
	</form>
</div>
<hr>
<div class="lisatud-broneeringud">
	<div class="sisestatud">
		<p><b>Siia kuvatakse kõik hetkel sisestatud broneeringud kuupäeva ja algusaja järgi sorteeritult.</b>
		<?php 
				error_reporting(-1);
		$mysqli = new mysqli("localhost", "test", "t3st3r123", "test");
		 
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		mysqli_set_charset($mysqli,"utf8");
		$query = "SELECT * FROM `sirle_broneering` INNER JOIN `sirle_restoran` ON sirle_broneering.rid = sirle_restoran.rid ORDER BY `date` DESC, `time` ASC;";
		
		if ($result = $mysqli->query($query)) {
		 
			print "<br><table border='1' width='940px'><tr><td><b>Saabumise kuupäev</b></td><td><b>Saabumise aeg</b></td><td><b>Kestvus tundides</b></td><td><b>Külaliste arv</b></td><td><b>Kontaktisik</b></td><td><b>Valitud restoran</b></td><td><b>Kontakt number</b></td><td><b>Kommentaarid</b></td><td><b>Broneeringu teostati</b></td></tr>" ;
			/* fetch associative array */
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row['date']."</td>";
				echo "<td>".$row['time']."</td>";
				echo "<td>".$row['duration']."</td>";
				echo "<td>".$row['number']."</td>";
				echo "<td>".$row['contact']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['tel']."</td>";
				echo "<td>".$row['comments']."</td>";
				echo "<td>".$row['bdate']."</td>";
				echo "<td><form action='change.php' method='POST'><input type='hidden' name='cid' value='".$row["id"]."'/><input type='submit' id='muuda' name='submit-btn' value='Muuda' /></form></td></tr>";
			} 
			print "</table>";
			/* free result set */
			$result->free();
		}
		 
		/* close connection */
		$mysqli->close();
	?>
	</div>
</div>
<?php 
	include("footer.php");
?>