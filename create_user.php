<?php
session_save_path('/afs/ir.stanford.edu/users/s/k/skyguy/cgi-bin/stagebuddy_temp/temp');
session_start();

include("config.php");

$username = mysql_real_escape_string($_POST['username']);
$password = md5(mysql_real_escape_string($_POST['password']));
$userID=uniqid();
	
$query_info = "INSERT INTO Users VALUES ('$username', '$userID','$password')";
mysql_query($query_info);

$_SESSION['id'] = $userID;
$_SESSION['username'] = $username;

?>

<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="height=device-height, initial-scale=1"> 

	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	
	<link rel="apple-touch-icon" href="StageBuddyHighResIcon.png" />
	<link rel="apple-touch-startup-image" href="StageBuddyHighResLaunchImage.png" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="jscript.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="content">	 
	You have successfully created an account. Click to go to your home page!
	<a href="index.php" data-role="button">Home</a>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>