<?php
	include ("header.php");
?>
<div class="chage-values">
	
	<?php
				
				if (isset($_POST['submit-btn'])){
				$id = $_POST['cid'];
				error_reporting(-1);
				$mysqli = new mysqli("localhost", "test", "t3st3r123", "test");
				 
				/* check connection */
				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				mysqli_set_charset($mysqli,"utf8");

				$query = "SELECT * FROM `sirle_broneering` INNER JOIN `sirle_restoran` ON sirle_broneering.rid = sirle_restoran.rid WHERE sirle_broneering.id = '$id';";
				 
				if ($result = $mysqli->query($query)) {
						 
							print "<table border='1' width='770px'><tr><td><b>Saabumise kuupäev</b></td><td><b>Saabumise aeg</b></td><td><b>Kestvus tundides</b></td><td><b>Külaliste arv</b></td><td><b>Kontaktisik</b></td><td><b>Valitud restoran</b></td><td><b>Kontakt number</b></td><td><b>Kommentaarid</b></td><td><b>Broneeringu teostati</b></td></tr>" ;
							/* fetch associative array */
							while ($row = $result->fetch_assoc()) {
								echo "<form method='POST'>";
								echo "<tr><td><input id='change' type='date' name='date' value='".$row['date']."'></td>";
								echo "<td><input id='change' type='time' name='arrive' value='".$row['time']."'></td>";
								echo "<td><input id='change' type='number' min='0' step='0.5' name='duration' value='".$row['duration']."'></td>";
								echo "<td> <input id='change' type='number' min='1' max='50' step='1' name='number' value='".$row['number']."'></td>";
								echo "<td>".$row['contact']."</td>";
								echo "<td>".$row['name']."</td>";
								echo "<td>".$row['tel']."</td>";
								echo "<td>".$row['comments']."</td>";
								echo "<td>".$row['bdate']."</td>";
								echo "<td>".$row['bdate']."</td>";
								echo "<td><input type='hidden' name='id' value='".$row['id']."'></td></tr>";
							} 
							print "</table>";
								echo "<input type='submit' name='renew' value='Uuenda kõik' />";
								echo "</form>";

							/* free result set */
							$result->free();
						}
						 
						/* close connection */
						$mysqli->close();

				}
	?>
	<?php

				if (isset($_POST['renew']))
				
					{	
									
						error_reporting(-1);
						$mysqli = new mysqli("localhost", "test", "t3st3r123", "test");
				 
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						mysqli_set_charset($mysqli,"utf8");
						
						$id = $_POST['id'];
						$date = $_POST['date'];
						$length = $_POST['duration'];
						$number = $_POST['number'];
						$arrive = $_POST['arrive'];
						
						$update = "UPDATE `sirle_broneering` SET `date`='$date',`time`='$arrive',`duration`='$length',`number`='$number' WHERE `id`= '$id'";
						if (mysqli_query($mysqli, $update)) {
							echo '<script>';
							echo 'setTimeout(function() { alert("Uuendus on edukalt lisatud!"); }, 0);';
							echo '</script>';
							header("location:broneering.php");

						} else {
							echo "Error updating record: " . mysqli_error($mysqli);
						}
					}
	?>
</div>

<?php
	include ("footer.php");
?>