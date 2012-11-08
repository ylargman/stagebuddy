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

<script type="text/javascript">
$(function(){
	$(".playbutton").click(function() {
		localStorage.setItem('currentPlay', $(this).attr("id"));
	});
	
	$(".testbutton").click(function() {
		x = localStorage.getItem('currentPlay');
		alert(x);
	});
	
});
</script>

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Stage Buddy</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<a href="createshow.html" data-role="button">+ New Show</a>
		
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
				<a href="acts_view.php" data-role="button" class="playbutton" id=<?php echo $playid?>><?php echo $name ?></a>
				<?php
				$p++;	
			}
		?>
		
		<a data-role="button" class="testbutton">Test</a>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>