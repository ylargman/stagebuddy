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

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<a href="index.html" data-icon="grid">Home</a>
		
		<h1>Acts</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="acts_view.php" data-role="button">
     		View</a>

     		<a href="acts_edit.php" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>

		<div data-role="navbar">
			<ul>
				<li><a href="a.html" class="ui-btn-active ui-state-persist">Act 1</a></li>
				<li><a href="b.html">Act 2</a></li>
				<li><a href="b.html">Act 3</a></li>
			</ul>
		</div><!-- /navbar -->
		
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<?php
			include("config.php");
			$query="SELECT * FROM Scenes";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$act=mysql_result($result, $i, "act");
			$scene=mysql_result($result, $i, "scene");
			$location=mysql_result($result, $i, "location");
			$time=mysql_result($result, $i, "time");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<div data-role="collapsible" class="sceneCollapsible" data-collapsed="false">
				<h3><div class="sceneName"><?php echo $act ?>.<?php echo $scene ?></div></h3>
				
				<form class="curSceneForm" data-ajax="false">
				
					<label for="location">Location:</label>
					<input type="text" name="location" id="location" value="<?php echo $location ?>"  />
					
					Timer: <?php echo $time ?>
					<a href="acts_edit.html" id="stopwatch" data-role="button" data-icon="custom" data-inline="true">Timer</a>
					
					<div data-role="fieldcontain">
						<fieldset data-role="controlgroup">
							<legend>Characters:</legend>
							<?php
							include("config.php");
					
							$cquery="SELECT * FROM Characters";
							$cresult=mysql_query($cquery);
							$numcrows=mysql_numrows($cresult);
				
							$k=0;
							while($k < $numcrows){
							
							$cname=mysql_result($cresult, $k, "name");
							$actbool=mysql_result($cresult, $k, "a{$act}s{$scene}");
							$charid="a{$act}s{$scene}-$cname";
							?>
							<input type="checkbox" name="<?php echo $charid ?>" id="<?php echo $charid ?>" class="custom"
							<?php
								if($actbool)
								echo 'checked="checked"'
							?>
							/>
							<label for="<?php echo $charid ?>"><?php echo $cname ?></label>
							<?php
							$k++;
							}
							?>
						</fieldset>
						<p></p>
						<fieldset data-role="controlgroup">
							<legend>Props:</legend>
							<?php
							include("config.php");
					
							$pquery="SELECT * FROM Props";
							$presult=mysql_query($pquery);
							$numprows=mysql_numrows($presult);
				
							$l=0;
							while($l < $numprows){
							
							$pname=mysql_result($presult, $l, "name");
							$actboolp=mysql_result($presult, $l, "a{$act}s{$scene}");
							$propid="a{$act}s{$scene}-$pname";
							?>
							<input type="checkbox" name="<?php echo $propid ?>" id="<?php echo $propid ?>" class="custom"
							<?php
								if($actboolp)
								echo 'checked="checked"'
							?>
							/>
							<label for="<?php echo $propid ?>"><?php echo $pname ?></label>
							<?php
							$l++;
							}
							?>
						</fieldset>
						
						<p></p>
						<label for="sceneNotes">Notes:</label>
						<textarea name="sceneNotes" id="sceneNotes">
						<?php echo $notes ?>
						</textarea>
					</div>
				</form>
				
				<a data-role="button" data-inline="true"
				class="savescene">Save</a>
				<a data-role="button" data-inline="true"
				class="deletescene">Delete</a>
			</div>
			
			<?php
			$i++;
			}
			?>
			
	
			<div data-role="collapsible">
			<h3>1.2</h3>
				<p>
					<label for="location">Location:</label>
    				<input type="text" name="name" id="location" value=""  />
    				
    				Timer: 0:30
    				<a href="acts_edit.html" id="stopwatch" data-role="button" data-icon="custom" data-inline="true">Timer</a>
    				
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Characters:</legend>
	   						<input type="checkbox" name="character1" id="character1" class="custom" />
	   						<label for="character1">Shag</label>
	   						
	   						<input type="checkbox" name="character2" id="character2" class="custom" />
	   						<label for="character2">Judith</label>
   					 	</fieldset>
					</div>
					
    				<input type="text" name="name" id="newcharacter" value="Add a new character"  />
					
					<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Props:</legend>
	   						<input type="checkbox" name="prop1" id="prop1" class="custom" />
	   						<label for="prop1">feather duster</label>
	   						
	   						<input type="checkbox" name="prop2" id="prop2" class="custom" />
	   						<label for="prop2">packages</label>
   					 	</fieldset>
   					 	
   					 	<input type="text" name="name" id="newprop" value="Add a new prop"  /><p>
   					 	</p>
   					 	
   					 	<label for="textarea-a">Notes:</label>
						<textarea name="textarea" id="textarea-a">
This scene comes second.  It's a good one.
						</textarea>
					</div>

				</p>
			</div>
	
		</div>
				
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