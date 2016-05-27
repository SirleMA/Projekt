<?php 
	include("header.php");
?>
<div class="log-in">
	<form name="login" method="POST" action="check.php">
		Kasutajanimi: <input type="text" name="username"/>
		Salasõna: <input type="password" name="password"/>
		<input type="submit" name="submit" value="Logi sisse"/>
	</form>
</div>
<?php 
	include("footer.php");
?>