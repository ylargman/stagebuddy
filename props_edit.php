<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="a" data-content-theme="a">

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
	
		      
		<form action="submit.php" method="post" data-ajax="false">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props_view.php?playID=<?php echo $playID?>" data-role="button">
     		View</a>

     		<a href="props_edit.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>
		
		<p></p>
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<ul data-role="listview" data-filter="true" class="outer-ul">
			<?php
			include("config.php");

			$query="SELECT * FROM PropsInfo WHERE playID LIKE '{$playID}' ORDER BY name";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$propID=mysql_result($result, $i, "propID");
			$name=mysql_result($result, $i, "name");
			$notes=mysql_result($result, $i, "notes");
			?>
			<li>
			<div class="propCollapsible itemCollapsible" data-role="collapsible" data-collapsed="true">
			<h3><div class="propName"><?php echo $name ?></div></h3>
			<p>    				
			
			<a data-role="button" data-inline="true" class="saveprop">Save</a>
			<a href="#deletePropPopup<?php echo $i?>" data-rel="popup" data-role="button" data-inline="true">Delete</a>
			<div data-role="popup" class="deletePropPopup" id="deletePropPopup<?php echo $i?>">
				<input type="hidden" class="currPropID" value=<?php echo $propID ?>>
				<p>Are you sure you wish to delete?<p> 
				<p>(Tap elsewhere to cancel)<p>
				<a data-role="button" data-inline="true" class="deleteprop">Delete</a>
			</div>
			
				<form class="curPropForm" data-ajax="false">
					<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
					<input type="hidden" class="currPropID" value=<?php echo $propID ?>>
					
    				<div data-role="fieldcontain">
    					<label for="propname">Prop:</label>
   				 		<input type="text" name="propname" id="propname" value="<?php echo $name ?>"  />
    					
    					<fieldset data-role="controlgroup">
    					
       						<legend>Scenes:</legend>
    						<div data-role="collapsible-set" data-theme="a" data-content-theme="a">
    						<?php
	   						include("config.php");
	   						$query_acts="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	   						$result_acts=mysql_query($query_acts);
	   						
	   						$act=1;
	   						while($act <= 10){
	   							$numscenes=mysql_result($result_acts, '0', "act{$act}");
	   							if($numscenes < 1)
	   								break;
									
								?>
								<div data-role="collapsible">
								<h2>Act <?php echo $act ?></h2>
								<?php
									
	   							$scene=1;
	   							while($scene <=$numscenes){
	   								$query_ps = "SELECT * FROM PropsScenes WHERE propID LIKE '{$propID}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}'";
									$results_ps = mysql_query($query_ps);
									if($results_ps){
										$numrows_ps=mysql_numrows($results_ps);
									}
									else{
										$numrows_ps=0;
									}
									

									$pid="a{$act}s{$scene}prop{$propID}";
									?>
									<input type="checkbox" name="<?php echo $pid ?>" id="<?php echo $pid ?>" class="custom" 
									<?php
									if($numrows_ps > 0)
										echo 'checked="checked"';
										
	   								$query_sn="SELECT * FROM Scenes WHERE playID LIKE '{$playID}' AND act=$act AND scene=$scene";
									$result_sn=mysql_query($query_sn);
									$numrows_sn=mysql_numrows($result_sn);
									if($numrows_sn > 0){
										$scName=mysql_result($result_sn, '0', "name");
									}
									else{
										$scName = NULL;
									}									?>/>
									<label for="<?php echo $pid ?>"><?php echo "{$act}.{$scene} {$scName}" ?></label>
									<?php
									$scene++;
	   							}
	   							$act++; ?>
							</div>
							<?php
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
				<a data-role="button" data-inline="true" class="saveprop">Save</a>
				<a href="#deletePropPopup<?php echo $i?>" data-rel="popup" data-role="button" data-inline="true">Delete</a>
				<div data-role="popup" class="deletePropPopup" id="deletePropPopup<?php echo $i?>">
					<input type="hidden" class="currPropID" value=<?php echo $propID ?>>
					<p>Are you sure you wish to delete?<p> 
					<p>(Tap elsewhere to cancel)<p>
					<a data-role="button" data-inline="true" class="deleteprop">Delete</a>
				</div>
			</p>
			</div>
			</li>
			<?php
			$i++;
			}
			?>
			</ul>
			
			<h3>Add New Prop</h3>
			<form action="insert_prop.php" method="post" id="newPropForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>

				<p>    				
    				<div data-role="fieldcontain">
						<label for="newpropname">Prop name:</label>
						<input type="text" name="newpropname" id="newpropname" value=""  />
						
						
    					<fieldset data-role="controlgroup">
						<legend>Scenes:</legend>
						<div data-role="collapsible-set" data-theme="a" data-content-theme="a">
						<?php
						include("config.php");
						$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
						$result_as=mysql_query($query_as);
						
						$a=1;
						while($a <= 10){
							$numscenes_as=mysql_result($result_as, '0', "act{$a}");
							if($numscenes_as < 1)
								break;
							$sc=1;
							?>
							<div data-role="collapsible">
							<h2>Act <?php echo $a ?></h2>
							<?php
							while($sc <=$numscenes_as){
								$asid="a{$a}s{$sc}";
	   							$query_sn="SELECT * FROM Scenes WHERE playID LIKE '{$playID}' AND act=$a AND scene=$sc";
								$result_sn=mysql_query($query_sn);
								$numrows_sn=mysql_numrows($result_sn);
								if($numrows_sn > 0){
									$scName=mysql_result($result_sn, '0', "name");
								}
								else{
									$scName = NULL;
								}
								?>
								<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
								<label for="<?php echo $asid ?>"><?php echo "{$a}.{$sc} {$scName}" ?></label>
								<?php
								$sc++;
							}
							$a++;
							?>
							</div>
							<?php
						}
					?>
						</div>
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
			<li><a href="acts_view.php?playID=<?php echo $playID ?>" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID ?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID ?>" id="props" data-icon="custom" class="ui-btn-active">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID ?>" id="elements" data-icon="custom">Set Elements</a></li>
			<li><a href="people_view.php?playID=<?php echo $playID?>" id="people" data-icon="custom" data-transition="slide">People</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>