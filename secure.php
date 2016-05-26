<?php 
	include($_SERVER["DOCUMENT_ROOT"] . "/Projekt/header.php");
?>
<p> Tere Anu!
<div class="intro">
	<p>Oled edukalt sisse loginud.
	<p>Oma tegevuse jätkamiseks palun valida all olevast nupureast omale sobiv tegevus.
	<p>Kui on avatud uus restoran ning seda veel ei ole kuvatud, siis lisa uus restoran vajutades nupule "Sisesta restorane"
	<p>Kui on tulnud laua broneering, siis vajuta "Sisesta broneering" ning täida kliendi andmed ning saadud info.
</div>
<div class="nupud">
	<button type="button"><a href="./restoran.php">Sisesta restorane</a></button>
	<button type="button"><a href="./broneering.php">Sisesta broneering</a></button>
</div>