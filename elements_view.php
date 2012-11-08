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
		<a href="index.php" data-icon="grid">Home</a>
		<h1>Set Elements</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="elements__view.php" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="elements_edit.php" data-role="button">
     		Edit</a>
			</fieldset>
		</form>

	<div data-role="content">	      
		
		
		<div class="ui-grid-b">
				<div class="ui-block-a"><h3>Set Element<h3></div>
				<div class="ui-block-b"><h3>Scenes<h3></div>
				<div class="ui-block-c"><h3>Notes<h3></div>
			</div><!-- /grid-b -->
		
		<?php
			include("config.php");
			$query="SELECT * FROM ElementsInfo WHERE playID LIKE '0'";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$elementID=mysql_result($result, $i, "elementID");
			$name=mysql_result($result, $i, "name");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<p> 
			<div class="ui-grid-b">
				<div class="ui-block-a"><img src="bow-and-arrow.png"/><p></p><?php echo $name ?></div>
					<div class="ui-block-b">
						<?php
							$query_s_n="SELECT * FROM ElementsScenes WHERE playID LIKE '0' AND elementID LIKE $elementID";
							$result_s_n=mysql_query($query_s_n);
							$numrows_s_n=mysql_numrows($result_s_n);
							
							$j=0;
							while($j < $numrows_s_n){
								$act=mysql_result($result_s_n, $j, "act");
								$scene=mysql_result($result_s_n, $j, "scene");
								echo $act;
								echo ".";
								echo $scene;
								echo "<br>";
								$j++;
							}
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
			<li><a href="elements_view.php" id="elements" data-icon="custom">Set Elements</a></li>
			<li><a href="scheduler.html" id="scheduler" data-icon="custom">Scheduler</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>