<?php

session_start();
$id = $_SESSION['userid'];
$fname = $_SESSION['userfname'];
$lname = $_SESSION['userlname'];
$pic = $_SESSION['profpic'];
$post = mysql_real_escape_string($_POST['tfArea']);

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("webapp") or die("Cannot connect to database");
$query = mysql_query("SELECT * from users WHERE userid='$id'");
$exists = mysql_num_rows($query);
$tablename = "";
$tablepic = "";

if ($exists > 0) {
	while ($row = mysql_fetch_assoc($query)) {
		if (isset($_POST['anon'])) {
			$tablepic = "anon.jpg";
			$tablename = "Anonymous";
			mysql_query("INSERT INTO posts (submittext,sender,senderpic) VALUES ('$post','$tablename','$tablepic')");
			Print '<script>window.location.assign("userPagev2.php");</script>';
		}else {
			$tablepic = $row['profpic'];
			$tablename = $row['firstname'];
			mysql_query("INSERT INTO posts (submittext,sender,senderpic) VALUES ('$post','$tablename','$tablepic')");
			Print '<script>window.location.assign("userPagev2.php");</script>';
		}
	}
}
?>