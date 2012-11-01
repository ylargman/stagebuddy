<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<a href="index.html" data-icon="grid">Home</a>
		<h1>Props</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props_view.php" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="props_edit.php" data-role="button">
     		Edit</a>
			</fieldset>
		</form>

	<div data-role="content">	      
		
		
		<div class="ui-grid-b">
				<div class="ui-block-a"><h3>Prop<h3></div>
				<div class="ui-block-b"><h3>Scenes<h3></div>
				<div class="ui-block-c"><h3>Notes<h3></div>
			</div><!-- /grid-b -->
		
		<?php
			include("config.php");
			$query="SELECT * FROM Props";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$name=mysql_result($result, $i, "Name");
			$a1s1=mysql_result($result, $i, "a1s1");
			$a1s2=mysql_result($result, $i, "a1s2");
			$notes=mysql_result($result, $i, "Notes");
			?>
			
			<p> 
			<div class="ui-grid-b">
				<div class="ui-block-a"><img src="bow-and-arrow.png"/><p></p><?php echo $name ?></div>
					<div class="ui-block-b">
						<?php
							if($a1s1){
								echo "1.1 <br>";
							}
							if($a1s2)
								echo "1.2 <br>";
						?>
					</div>
					<div class="ui-block-c"><?php echo $notes ?></div>
				</p>
				</div><!-- /grid-b -->
			<?php
			$i++;
			}
			?>
			
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php" id="props" data-icon="custom">Props</a></li>
			<li><a href="scheduler.html" id="scheduler" data-icon="custom">Scheduler</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>