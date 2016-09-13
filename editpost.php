<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>USC Freedom Wall</title>
    	<!--CSS-->
    	<link rel="stylesheet" type="text/css" href="resource/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="resource/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="resource/customcss/userPage.css">
        <link rel="icon" type="image/png" href="resource/images/logo2.png">

	</head>
		<?php
		session_start(); //starts the session
		if($_SESSION['userid']){ //checks if user is logged in
		}
		else{
			header("location:indexv2.html"); // redirects if user is not logged in
		}
		$id = $_SESSION['userid']; //assigns user value
		$fname = $_SESSION['userfname'];
		$lname = $_SESSION['userlname'];
		$pic = $_SESSION['profpic'];
		$password = $_SESSION['pass'];
		$tablepostid = $_SESSION['postid'];
	?>
	<body>
		<!--NAV-->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
					
					</div>
					<div class="col-sm-3">
						<ul class="nav navbar-nav">
							<li><img src="resource/images/logo2.png" id="logo-nav"></li>
						</ul>
					</div>
					<div class="col-sm-4">

			        </li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<!--END OF NAV-->
		<!--Content-->
		<div class="container" style="margin-top:50px;">
			<div class="row profile">
				<div class="col-sm-3">
					<div class="profile-sidebar">
							<div class="profile-userpic" >
										<a href="#viewPic" data-toggle="modal"><img src="resource/images/<?php Print $pic; ?>" class="img-responsive img-circle" alt=""></a>
    									</div>
    									<div class="profile-usertitle">
    									<div class="profile-usertitle-name">
                						<?php Print $id; ?><br>
    									<?php Print $fname ?> <?php Print $lname ?>
    									</div>
    						<div class="profile-usertitle-course">
    							BSICT
	    					</div>
	    				</div>
	    				
					</div>
				</div>

				<div class="col-sm-6">

					<!--Status-->
					<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/



// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($postid, $submittext,  $error)

{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="hidden" name="postid" value="<?php echo $postid; ?>"/>

<div>



<div class="col-sm-6"  >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header"><h4><b>Edit Post</b></h4></div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
									
	<textarea style="width:100%;  resize:none;" name="submittext"><?php echo $submittext; ?>	</textarea>



<button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>

<button type="button" class="btn btn-success"  value="cancel" onClick="window.location='userPagev2.php';">Cancel</button>

							</div>
						</div>
					</div>
				</div>
</div>

</form>

</body>

</html>

<?php

}






// connect to the database

include('connect.php');



// check if the form has been submitted. If it has, process the form and save it to the database
if(isset($_POST['']))
{

}

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['postid']))

{

// get form data, making sure it is valid

$postid = $_POST['postid'];

$submittext = mysql_real_escape_string(htmlspecialchars($_POST['submittext']));





// check that firstname/lastname fields are both filled in

if ($submittext == '' )

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($postid, $submittext,  $error);

}

else

{

// save the data to the database

mysql_query("UPDATE posts SET submittext='$submittext' WHERE postid='$postid'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: userPagev2.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['postid']) && is_numeric($_GET['postid']) && $_GET['postid'] > 0)

{

// query db

$postid = $_GET['postid'];

$result = mysql_query("SELECT * FROM posts WHERE postid=$postid")

or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$submittext = $row['submittext'];




// show form

renderForm($postid, $submittext, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>
					
			
















