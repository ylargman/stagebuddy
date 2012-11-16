<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="b" data-content-theme="b">

	<div data-role="header" data-position="fixed">
		<a href="index.php" data-icon="grid">Home</a>
		<a href="login.php" data-icon="gear" data-ajax="false">Change User</a>
		<h1>
		<?php
			include("config.php");
			$playID = $_GET['playID'];
			
			$query_i="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
			$result_i=mysql_query($query_i);
			$numrows_i=mysql_numrows($result_i);
			
			$name=mysql_result($result_i, '0', "name");
			echo $name;
		?>
		</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props_view.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="props_edit.php?playID=<?php echo $playID?>" data-role="button">
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
			$query="SELECT * FROM PropsInfo WHERE playID LIKE '{$playID}'";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$propID=mysql_result($result, $i, "propID");
			$name=mysql_result($result, $i, "name");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<p> 
			<div class="ui-grid-b">
				<div class="ui-block-a"><?php echo $name ?></div>
					<div class="ui-block-b">
						<?php
							$query_s_n="SELECT * FROM PropsScenes WHERE propID LIKE '{$propID}' AND playID LIKE '{$playID}' ORDER BY act, scene";
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
					<div class="ui-block-a"><br></div>
					<div class="ui-block-b"><br></div>
					<div class="ui-block-c"><br></div>
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
			<li><a href="acts_view.php?playID=<?php echo $_GET['playID']?>" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom" class="ui-btn-active">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>