<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	
	<script src="jscript.js"></script>
	
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	
</head> 

<body> 
<?php
	include("config.php");
	session_start();
	$userid = $_SESSION['id'];
?>
<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="header" >
		<a href="index.php" data-icon="back">Back</a>
		<h1>Create a Show</h1>
	</div><!-- /header -->
	<input type="hidden" name="userID" id="userID" value=<?php echo $userid ?>>
	<div data-role="content">
		<div data-role="fieldcontain">
	         <label for="playname">Show Title:</label>
	         <input type="text" name="playname" id="playname" value="" />
		</div>
		<div data-role="fieldcontain">
	         <label for="numActs">Number of Acts:</label>
	         <input type="number" name="numActs" id="numActs" value="" />
		</div>
		<div data-role="fieldcontain">
	         <input type="submit" name="generate" id="generate" class="generateButton" value="Generate" />
		</div>
		<div data-role="popup" id="scenePop" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			<div id="scenePopContents"></div>
		</div>
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>