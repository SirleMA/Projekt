<?php
$host = "localhost";
$username = "root";
$password = "root";
$db_name = "pitsa";
$tbl_name = "users";

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");
$username = $_POST['username'];
$password = $_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$sql = "SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count == 1){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
	header("location:secure.php");
} else {
	echo "Wrong Username or Password";
}
?>