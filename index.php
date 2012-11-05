<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="height=device-height, initial-scale=1"> 

	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<link rel="apple-touch-icon" href="StageBuddyHighResIcon.png" />
	<link rel="apple-touch-startup-image" href="StageBuddyHighResLaunchImage.png" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="jscript.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Stage Buddy</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<a href="createshow.html" data-role="button">+ New Show</a>
		
		<?php
			
		?>
		
		<a href="acts_view.php" data-role="button">Hamlet</a>
		<a href="acts_view.php" data-role="button">Peter Pan</a>
		<a href="acts_view.php" data-role="button">Equivocation</a>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>