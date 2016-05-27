<?php
	include ("header.php");
?>

		<div class="banner">
			<img src="./images/banner.png">
		</div><!-- banner ends -->
		<div class="tekstiala">
			<div class="tekst1">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non ligula eu elit iaculis sodales eu non enim. Etiam faucibus blandit fringilla. Ut nec elit commodo, porttitor mauris in, condimentum erat.
				<p>Vivamus egestas elit at pretium condimentum. Duis maximus odio eu ante lobortis viverra. Donec eget semper felis. Etiam consequat sodales turpis, a malesuada odio iaculis nec. Sed in placerat enim. Proin justo nunc, luctus suscipit lobortis a, commodo vitae lectus. Nullam mollis erat in rutrum interdum.
			</div><!-- tekst1 ends -->
			<div class="tekst2">
				<p>Nullam ante eros, commodo id vehicula sit amet, feugiat at ligula. Quisque in augue convallis, vestibulum velit quis, interdum dui. Vestibulum consectetur id neque ac pellentesque. Pellentesque placerat venenatis mollis. Proin leo dolor, lacinia at scelerisque quis, dapibus sit amet dolor. 
				<p>Maecenas lobortis elit sit amet lorem dignissim viverra id in dolor. Nulla facilisi. Phasellus a nibh interdum, pellentesque nibh id, venenatis nunc. Suspendisse rutrum felis ac tellus luctus, in varius sem egestas. Vivamus sodales sollicitudin elit id pellentesque.
			</div><!-- tekst2 ends -->
		</div><!-- tekstiala ends -->
		<div class="broneeri">
		<hr>
		<p> Selleks, et broneerida pizza restorani laud/lauad palume täita allolev vorm:
			<form id="broneering" name="broneering" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input id="front" type="text" name="name" placeholder="Nimi">
				<input id="front" type="text" name="phone" placeholder="Telefon">
				<input id="front" type="text" name="arrive" placeholder="Kellaaeg" onfocus="(this.type='time')">
				<select name="restaurant">
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
							$id = $row['rid'];
							$name = $row['name']; 
							echo '<option value="'.$id.'">'.$name.'</option>';
						}				
					?>
				</select>
				<input id="front" type="date" name="date" placeholder="Kuupäev">
				<input id="front" type="number" min="0" step="0.5" name="length" placeholder="Kestvus tundides">
				<input id="front" type="number" min="1" max="50" step="1" name="number" placeholder="Inimeste arv">
				<textarea id="front" form ="broneering" name="comments" cols="26" wrap="soft" placeholder="Lisa kommentaarid"></textarea>
				<input type="submit" name="rsubmit" value="Salvesta"/>
				<?php
			
			if (!empty($_POST['rsubmit'])) {
				error_reporting(E_ALL ^ E_STRICT);
		
			if(empty($_POST['name'])){
				echo '<script>';
				echo 'alert("Eesnimi nimi on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['phone'])){
				echo '<script>';
				echo 'alert("Telefoninumber on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['arrive'])){
				echo '<script>';
				echo 'alert("Kellaaeg on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['date'])){
				echo '<script>';
				echo 'alert("Kuupäev on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['length'])){
				echo '<script>';
				echo 'alert("Kestvus on kohustuslik väli!");';
				echo '</script>';
			} else if(empty($_POST['number'])){
				echo '<script>';
				echo 'alert("Inimeste arv on kohustuslik väli!");';
				echo '</script>';
			} else {
				$name = $_POST['name']; 
				$phone = $_POST['phone'];
				$date = $_POST['date'];
				$length = $_POST['length'];
				$number = $_POST['number'];
				$comments = $_POST['comments'];
				$restaurant = $_POST['restaurant'];
				$arrive = $_POST['arrive'];
				
			$query = mysql_query("INSERT INTO `sirle_broneering`(`id`, `rid`, `date`, `time`, `duration`, `number`, `contact`, `kid`, `tel`, `comments`, `bdate`) VALUES ('','$restaurant','$date','$arrive','$length','$number','$name','','$phone','$comments',NOW())")or die(mysql_error());
			$result = mysql_query($query);
				echo '<script>';
				echo 'alert("Broneering on edukalt sisestatud!");';
				echo '</script>';
				}
			}
		?>
			</form>
		</div><!-- broneeri ends -->
<?php
	include ("footer.php");
?>