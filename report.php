<?php
	session_start(); //starts the session

	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysql_select_db("webapp") or die("Cannot connect to database"); //Connect to database
		$id = $_GET['id'];
		mysql_query("UPDATE posts SET reports = reports + 1 WHERE postid = $id");
		header("location: userPagev2.php");
	}
?>