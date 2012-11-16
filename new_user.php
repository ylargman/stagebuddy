<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="height=device-height, initial-scale=1"> 

	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<link rel="apple-touch-icon" href="StageBuddyHighResIcon.png" />
	<link rel="apple-touch-startup-image" href="StageBuddyHighResLaunchImage.png" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="jscript.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<?php
session_start();
?>

<div data-role="page" data-theme="b" data-content-theme="b">

	<div data-role="content">	 
	<form action="create_user.php" method="post" id="login">
		<h2><span>Create User</span></h2>
		
		<p><label>Username</label></p>
		<input type="text" id="username" name="username" />
		</p>
		
		<p><label>Password</label>
		<input type="password" id="password" name="password"/></p>
		
		<input type="submit" value="Create" />
	</form>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>