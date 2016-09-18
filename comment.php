<?php
session_start();
$postid = $_SESSION['postcommentid'];
$pic = $_SESSION['profpic'];
$fname = $_SESSION['userfname'];
mysql_connect("localhost", "root","") or dsie(mysql_error()); //Connect to server
mysql_select_db("webapp") or die("Cannot connect to database"); //Connect to database
$comment = htmlspecialchars($_POST['comm']);
mysql_query("INSERT INTO comments (comment,profpic,name,postid) VALUES ('$comment','$pic','$fname','$postid')");
header("location: userPagev2.php");
?>