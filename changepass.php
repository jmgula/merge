<?php

session_start();
$id = $_SESSION['userid'];
$oldpass = mysql_real_escape_string($_POST['oldpassword']);
$newpass = mysql_real_escape_string($_POST['newpassword']);
$confpass = mysql_real_escape_string($_POST['confnewpass']);

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("webapp") or die("Cannot connect to database");
$query = mysql_query("SELECT * from users WHERE userid='$id'");
$exists = mysql_num_rows($query);
$table_pass = "";

if ($exists > 0) {
	while ($row = mysql_fetch_assoc($query)) {
		$table_pass = $row['password'];
	}
	if ($table_pass != $oldpass) {
		Print '<script>alert("Incorrect password");</script>';
		Print '<script>window.location.assign("userPagev2.php");</script>';
	}
	if ($newpass != $confpass) {
	Print '<script>alert("New passwords do not match");</script>';
	Print '<script>window.location.assign("userPagev2.php");</script>';
	}
	if (($table_pass == $oldpass) && ($newpass == $confpass)) {
		mysql_query("UPDATE users SET password='$confpass' WHERE userid='$id'");
		$_SESSION['pass'] = $confpass;
		Print '<script>alert("Password change successful");</script>';
		Print '<script>window.location.assign("userPagev2.php");</script>';
	}
}

?>