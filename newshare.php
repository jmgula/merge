<?php
session_start();
$text = mysql_real_escape_string($_POST['tfArea']);

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("webapp") or die("Cannot connect to database");
$query = mysql_query("SELECT * FROM posts WHERE submittext='$text'");
$exists = mysql_num_rows($query);
$tabletext = "";

if ($exists > 0) {
	Print '<script>alert("Post already exists!");</script>';
	Print '<script>window.location.assign("userPagev2.php");</script>';
}else{
	while ($row = mysql_fetch_assoc($query)) {
		$tabletext = $row['submittext'];
	}
	mysql_query("INSERT INTO posts (submittext) VALUES ('$text')");
	Print '<script>window.location.assign("userPagev2.php");</script>';
}
?>