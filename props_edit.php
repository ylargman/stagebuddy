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

	<div data-role="header">
		<a href="index.html" data-icon="grid">Home</a>
		<h1>Props</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props.html" data-role="button">
     		View</a>

     		<a href="props_edit.html" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>
		
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">

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
			<div data-role="collapsible" data-collapsed="false">
			<h3><?php echo $name ?></h3>
			<p>    				
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<input type="checkbox" name="scene1" id="scene1" class="custom"
							<?php
							if($a1s1)
							echo 'checked="checked"'
							?>
							/>
	   						<label for="scene1">1.1</label>
	   						
	   						<input type="checkbox" name="scene2" id="scene2" class="custom"
							<?php
							if($a1s2)
							echo 'checked="checked"'
							?>
							/>
	   						<label for="scene2">1.2</label>
   					 	</fieldset>
					<p>
   					</p>
					<label for="textarea-a">Notes:</label>
						<textarea name="textarea" id="textarea-a"><?php echo $notes ?>
						</textarea>

					</div>
				</p>
			</div>
			<?php
			$i++;
			}
			?>
			
			
			<div data-role="collapsible" data-collapsed="false">
			<h3>Feather duster</h3>
			<p>    				
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<input type="checkbox" name="scene1" id="scene1" class="custom" />
	   						<label for="scene1">1.1</label>
	   						
	   						<input type="checkbox" name="scene2" id="scene2" class="custom" />
	   						<label for="scene2">1.2</label>
   					 	</fieldset>
					<p>
   					</p>
					<label for="textarea-a">Notes:</label>
						<textarea name="textarea" id="textarea-a">
This prop comes first.  It's the worst.
						</textarea>

					</div>
				</p>
			</div>
	
			<div data-role="collapsible">
			<h3>Packages</h3>
				<p>    				
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<input type="checkbox" name="scene1" id="scene1" class="custom" />
	   						<label for="scene1">1.1</label>
	   						
	   						<input type="checkbox" name="scene2" id="scene2" class="custom" />
	   						<label for="scene2">1.2</label>
   					 	</fieldset>
					<p>
   					</p>
					<label for="textarea-a">Notes:</label>
						<textarea name="textarea" id="textarea-a">
This prop comes second.  It's a good one.
						</textarea>

					</div>
				</p>
			</div>
			<div data-role="collapsible" data-collapsed="false">
			<form action="insert.php" method="post"> 
			<h3>Add New Prop</h3>
				<p>    				
    				<div data-role="fieldcontain">
						<label for="newpropname">Prop name:</label>
						<input type="text" name="newpropname" id="newpropname" value=""  />
						
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<input type="checkbox" name="a1s1" id="a1s1" class="custom" />
	   						<label for="a1s1">1.1</label>
	   						
	   						<input type="checkbox" name="a1s2" id="a1s2" class="custom" />
	   						<label for="a1s2">1.2</label>
   					 	</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" value="Create Prop" />

					</div>
				</p>
			</form>
			</div>
	
		</div>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts.html" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters.html" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props.html" id="props" data-icon="custom">Props</a></li>
			<li><a href="scheduler.html" id="scheduler" data-icon="custom">Scheduler</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>