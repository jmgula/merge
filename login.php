<?php
	session_start();
	$id = mysql_real_escape_string($_POST['idnumber']);
	$password = mysql_real_escape_string($_POST['pass']);

	mysql_connect("localhost", "root", "") or die(mysql_error()); //Connect to server
	mysql_select_db("webapp") or die("Cannot connect to database"); //Connect ot database
	$query = mysql_query("SELECT * from users WHERE userid='$id'"); //Query the users table if there are matching rows equal to $username
	$exists = mysql_num_rows($query); //Checks if username exists
	$table_id = "";
	$table_password = "";
	$table_fname = "";
	$table_lname = "";
	$table_pic = "";
	if ($exists > 0) //If there are no returning rows or no existing username
	{
		while ($row = mysql_fetch_assoc($query)) //Display all rows from query
		{
			$table_id = $row['userid']; //The first username row is passed on to $table_users, and so on until the query is finished
			$table_password = $row['password']; //The first password row is passed on to $table_users, and so on until the query is finished
			$table_fname = $row['firstname'];
			$table_lname = $row['lastname'];
			$table_pic = $row['profpic'];
		}
		if (($id == $table_id) && ($password == $table_password)) //Checks if there are any matching fields
		{
			if ($password == $table_password)
			{
				$_SESSION['userid'] = $table_id; 
				$_SESSION['userfname'] = $table_fname;
				$_SESSION['userlname'] = $table_lname;
				$_SESSION['profpic'] = $table_pic;
				$_SESSION['pass'] = $table_password;
				header("location: userPagev2.php"); //Redirects the user to the authenticated home page
			}
		}
		else
		{
			Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
			Print '<script>window.location.assign("indexv2.html");</script>'; //Redirects to login.php
		}
	}
	else 
	{
		Print '<script>alert("Incorrect Username!")</script>'; //Prompts the user
		Print '<script>window.location.assign("indexv2.html");</script>'; //Redirects to login.php
	}
?>