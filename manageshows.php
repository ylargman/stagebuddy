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

<div data-role="page" data-theme="b" data-content-theme="b">

	<div data-role="content">	 
	
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<h1>Stage Buddy</h1>
			</div>
			<div class="ui-block-b"></div>
			<div class="ui-block-c">
				<form action="submit.php" method="post">
					<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     				<a href="index.php" data-role="button">
     				Access</a>
					<a href="manageshows.php" data-role="button" class="ui-btn-active">
     				Manage</a>
					</fieldset>
				</form>
			</div>
			
			<div class="ui-block-a"><br><br><br>
				<h2>Click on a show to erase it and all its content.</h2>
			</div>
			
			<?php
				include("config.php");
				$query="SELECT * FROM Plays";
				$result=mysql_query($query);
				$numrows=mysql_numrows($result);
				
				$p=0;
				while($p < $numrows){
					$name=mysql_result($result, $p, "name");
					$playid=mysql_result($result, $p, "playID");
					?>
					<div class="ui-block-b">
						<div class="showButton">
						<form class="deleteShowForm" data-ajax="false">
						<a data-role="button" class="deleteshow" id=<?php echo $playid?>>
						<input type="hidden" name="currPlayID" value=<?php echo $playid ?>>
						<img src="playcover.png"/><br><?php echo $name ?><br>
						</a>
						</form>
						</div>
					</div>
					<?php
					$p++;	
				}
			?>
		
		</div>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>