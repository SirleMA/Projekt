<?php
	session_start();
	register_shutdown_function('shutdown');
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Mõnus Pitsa</title>
		<link rel="stylesheet" href="style.css">
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<div class="wrapper">
		<div class="header">
			<ul>
				<li class="nav-item"><a href="./index.php" class="nav">Esileht</a></li>
				<li class="nav-item"><a href="./menu.php" class="nav">Menüü</a></li>
				<li class="nav-item"><a href="./meist.php" class="nav">Meist</a></li>
				<li class="nav-item"><a href="./asukoht.php" class="nav">Asukoht</a></li>
				<li class="nav-item"><a href="./login.php" class="nav">Logi sisse</a></li>
			</ul>
		</div><!-- header ends -->
		<div class="content">

<?php
function footer() {
	exit;
}

function shutdown() {
	include($_SERVER["DOCUMENT_ROOT"] . "/Projekt/footer.php");
}
?>