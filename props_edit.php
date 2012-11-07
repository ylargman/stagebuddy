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
		<a href="index.php" data-icon="grid">Home</a>
		<h1>Props</h1>
	</div><!-- /header -->

	<div data-role="content">
	
		      
		<form action="submit.php" method="post" data-ajax="false">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props_view.php" data-role="button">
     		View</a>

     		<a href="props_edit.php" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>
		
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">

			<?php
			include("config.php");
			$query="SELECT * FROM PropsInfo WHERE playID LIKE '0'";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$propID=mysql_result($result, $i, "propID");
			$name=mysql_result($result, $i, "name");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<div class="propCollapsible" data-role="collapsible" data-collapsed="false">
			<h3><div class="propName"><?php echo $name ?></div></h3>
			<p>    				
				<form class="curPropForm" data-ajax="false">
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    					
       						<legend>Scenes:</legend>
    						
    						<?php
	   						include("config.php");
	   						$query_acts="SELECT * FROM Plays WHERE playID LIKE '0'";
	   						$result_acts=mysql_query($query_acts);
	   						
	   						$act=1;
	   						while($act <= 10){
	   							$numscenes=mysql_result($result_acts, '0', "act{$act}");
	   							if($numscenes < 1)
	   								break;
	   							$scene=1;
	   							while($scene <=$numscenes){
	   								$query_ps = "SELECT * FROM PropsScenes WHERE playID=0 AND propID=$propID AND act=$act AND scene=$scene";
									$results_ps = mysql_query($query_ps);
									$numrows_ps=mysql_numrows($results_ps);

									$pid="a{$act}s{$scene}prop{$propID}";
									?>
									<input type="checkbox" name="<?php echo $pid ?>" id="<?php echo $pid ?>" class="custom" 
									<?php
									if($numrows_ps > 0)
										echo 'checked="checked"'
									?>/>
									<label for="<?php echo $pid ?>"><?php echo "{$act}.{$scene}" ?></label>
									<?php
									$scene++;
	   							}
	   							$act++;
	   						}
	   					?>
   					 	</fieldset>
						<p>
						</p>
						<label for="propnotes">Notes:</label>
						<textarea name="propnotes" id="propnotes"><?php echo $notes ?>
						</textarea>
					</div>
				</form>
				<a data-role="button" data-inline="true"
				class="saveprop">Save</a>
				<a data-role="button" data-inline="true"
				class="deleteprop">Delete</a>
			</p>
			</div>
			<?php
			$i++;
			}
			?>
			
			
			<h3>Add New Prop</h3>
			<form action="insert_prop.php" method="post" id="newPropForm" data-ajax="false">
				<p>    				
    				<div data-role="fieldcontain">
						<label for="newpropname">Prop name:</label>
						<input type="text" name="newpropname" id="newpropname" value=""  />
						
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<?php
	   						include("config.php");
	   						$query_as="SELECT * FROM Plays WHERE playID LIKE '0'";
	   						$result_as=mysql_query($query_as);
	   						
	   						$a=1;
	   						while($a <= 10){
	   							$numscenes_as=mysql_result($result_as, '0', "act{$a}");
	   							if($numscenes_as < 1)
	   								break;
	   							$sc=1;
	   							while($sc <=$numscenes_as){
	   								$asid="{$a}.{$sc}";
	   								?>
									<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
									<label for="<?php echo $asid ?>"><?php echo $asid ?></label>
									<?php
									$sc++;
	   							}
	   							$a++;
	   						}
	   					?>
   					 	</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" id="createPropButton" value="Create Prop" />
					</div>
				</p>
				</p>
			</form>	
		</div>
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