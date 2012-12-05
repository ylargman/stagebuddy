<?php
	session_start();
    session_unset();
    session_destroy();
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
	<link rel="apple-touch-startup-image" href="StageBuddyLowResLaunchImage.png" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="jscript.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	
	<style type="text/css">
		.ui-page {
    		background: url(StageBuddyLowResBackground.png);
   			background-repeat:repeat-y;
    		background-position:center center;
    		background-attachment:scroll;
    		background-size:100% 100%;
		}
		
		[data-role=content]{
    		background: transparent;
		}
	</style>
</head>

<body style="background-image:url(StageBuddyLowResBackground.png)"> 
<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="content">	 
	<form action="index.php" method="post" id="login">
		<img src="Logo.png"/>
		<h2><span>Login</span></h2>
		
		<p><label>Username</label></p>
		<input type="text" id="username" name="username" />
		</p>
		
		<p><label>Password</label>
		<input type="password" id="password" name="password"/></p>
		
		<input type="submit" value="Login" data-theme="a"/>
	</form>
	<p></p>
	Or if you don't have a user account, click here to create one:
	<a href="new_user.php" data-role="button">Register</a>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>