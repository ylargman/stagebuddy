<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

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

<?php
	session_start();
	$userID = $_SESSION['id'];
?>

<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="content">	 
	
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<h1>Stage Buddy</h1>
			</div>
			<div class="ui-block-b"></div>
			<div class="ui-block-c">
				<form action="submit.php" method="post">
					<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     				<a href="index.php" data-role="button" data-ajax="false">
     				Access</a>
					<a href="manageshows.php" data-role="button" class="ui-btn-active"  data-ajax="false">
     				Manage</a>
					</fieldset>
				</form>
			</div>
			
			<div class="ui-block-a"><br><br><br>
				<h2>Click on a show to edit it. You can change a show's name or erase it and its content from this page.</h2>
			</div>
			
			<?php
				include("config.php");
				$query="SELECT * FROM Plays WHERE userID='$userID'";
				$result=mysql_query($query);
				$numrows=mysql_numrows($result);
				
				$p=0;
				while($p < $numrows){
					$name=mysql_result($result, $p, "name");
					$playid=mysql_result($result, $p, "playID");
				?>
					<div class="ui-block-b">
						<div class="showButton">
							<a href="#manageShowPopup<?php echo $p ?>" data-rel="popup" data-role="button" data-transition="pop"><img src="playcover.png"/><br><?php echo $name ?><br></a>
							
							<div data-role="popup" id="manageShowPopup<?php echo $p ?>" class="ui-content">
								<form class="changeShowForm" data-ajax="false">
									<label for="newShowName">Show Name:</label>
									<input type="text" name="newShowName" value="<?php echo $name ?>"/>
									<input type="submit" class="changeShowName" value="Change Show Name" />
									<input type="hidden" name="currPlayID" value="<?php echo $playid ?>"/>
									<a href="#popupBasic<?php echo $p ?>" data-rel="popup" data-role="button" data-transition="pop">Delete Show</a>
								</form>
							</div>
							
							<div data-role="popup" id="popupBasic<?php echo $p ?>">
								<p>Are you sure you wish to delete?<p> 
								<p>All content associated with this show will be erased.<p>
								<p>(Tap elsewhere to cancel)<p>
								<form class="deleteShowForm" data-ajax="false">
									<a data-role="button" class="deleteshow" id=<?php echo $playid?>>
									<input type="hidden" name="currPlayID" value=<?php echo $playid ?>>Delete</a>
								</form>
							</div>
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